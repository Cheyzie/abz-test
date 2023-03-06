<?php

namespace App\Rules;

use App\Models\Employee;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Log;

class SubordinationLevels implements ValidationRule
{

    public function __construct(
        private int $levels = 5,
        private ?Employee $currentEmployee = null
    ) {}

    private function countHeadsLevel(Employee $employee):int {
        $heads_level = 0;
        $head = $employee;
        while ($head) {
            $heads_level++;
            $head = $head->head;
        }
        return $heads_level;
    }

    private function countSubordinateLevel(Employee $employee, $acc = 0):int {
        $subordinateLevel = $acc;
        foreach ($employee->subordinates as $subordinate) {

            $newSubordinateLevel = $this->countSubordinateLevel($subordinate, ++$acc);

            if ($newSubordinateLevel > $subordinateLevel)
                $subordinateLevel = $newSubordinateLevel;

            if($subordinateLevel > $this->levels)
                return $subordinateLevel;
        }
        return $subordinateLevel;
    }

    public function checkCycle(Employee $newHead): bool {
        $head = $newHead;

        while ($head) {
            if ($head->id == $this->currentEmployee->id) {
                return true;
            }
            $head = $head->head;
        }

        return false;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $employee = Employee::where('full_name', $value)->first();

        $this->levels -= $this->countHeadsLevel($employee);

        if($this->levels > 0 && !is_null($this->currentEmployee)) {
            $this->levels -= $this->countSubordinateLevel($this->currentEmployee);
            if($this->checkCycle($employee)) {
                $fail('There is subordination cycle');
            }
        }

        if($this->levels < 1)
            $fail('Too great a level of subordination');
    }
}
