<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            "id" => $this->memberId,
            "branch_id" => '',
            "registration_date" => '',
            "receipt_no" => '',
            "member_title" => '',
            "first_name" => '',
            "middle_name" => "",
            "last_name" => '',
            "father_or_spouse_title" => '',
            "father_or_spouse_first_name" =>'',
            "father_or_spouse_middle_name" =>'',
            "father_or_spouse_last_name" => '',
            "date_of_birth" => '',
            "gender" => '',
            "marital_status" => '',
            "education" => '',
            "occupation" => '',
            "monthly_total_family_income" => '',
            "religion" => '',
            "caste" => '',
            "form_60A" => '',
            "pan_no" => '',
            "adhar_no" => '',
            "passport_no" => '',
            "nominee_title" => '',
            "nominee_first_name" => '',
            "nominee_middle_name" => '',
            "nominee_last_name" =>'',
            "nominee_date_of_birth" => '',
            "nominee_gender" => '',
            "nominee_relationship" => '',
            "active" => true,
            "created_by" => null,
            "updated_by" => null,
            "created_at" => '',
            "updated_at" => '',
            "deleted_at" => null,
            "same_as_current_address" => '',
            "same_as_permanent_address" => '',
            "age" => $this->age,
            "email" => " ",
            "mobile_no" => " ",
            "telephone_no" => " ",
            "fax" => " ",
            "laravel_through_key" => 1,
            "full_name" => " ",
            "profile_image" => null,
            "ymd_dob" => "", // 2001-01-05
            "ymd_nom_dob" => "",
            "ymd_reg" => "",
            "branch" => [
                "id" => 1,
                "client_id" => 1,
                "region_id" => 1,
                "zone_id" => 1,
                "branch_name" => " ",
                "address" => " ",
                "state" => " ",
                "city" => " ",
                "zip_code" => " ",
                "active" => true,
                "created_by" => null,
                "updated_by" => null,
                "created_at" => "03/17/2022 12:43 PM",
                "updated_at" => "03/17/2022 12:43 PM",
                "deleted_at" => null
            ],
            "addresses" => [
                [
                    "id" => 1,
                    "member_id" => 1,
                    "address_type" => "permanent_address",
                    "address" => "ghfdh",
                    "state" => "IN-MP",
                    "city" => "ghfgh",
                    "zip_code" => "12346799",
                    "mobile_no" => null,
                    "telephone_no" => null,
                    "fax" => null,
                    "email" => null,
                    "active" => true,
                    "created_by" => null,
                    "updated_by" => null,
                    "created_at" => "04/04/2022 08:10 AM",
                    "updated_at" => "04/04/2022 08:10 AM",
                    "deleted_at" => null
                ],
                [
                    "id" => 2,
                    "member_id" => 1,
                    "address_type" => "current_address",
                    "address" => null,
                    "state" => null,
                    "city" => null,
                    "zip_code" => null,
                    "mobile_no" => null,
                    "telephone_no" => null,
                    "fax" => null,
                    "email" => null,
                    "active" => true,
                    "created_by" => null,
                    "updated_by" => null,
                    "created_at" => "04/04/2022 08:10 AM",
                    "updated_at" => "04/04/2022 08:10 AM",
                    "deleted_at" => null
                ]
            ],
            "attachments" => []
        ];
    }
}
