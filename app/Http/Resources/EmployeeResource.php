<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'age' => $this->age,
            'salary' => $this->salary,
            'date_of_employment' => $this->date_of_employment,
            'manager_id' => $this->manager_id,
            'department_id' => $this->department_id,
            'is_founder' => $this->is_founder,
        ];

        if ($this->resource->relationLoaded('projects') && isset($this->projects_count)) {
            $data['projects_count'] = $this->projects_count;
        }

        return $data;
    }
}
