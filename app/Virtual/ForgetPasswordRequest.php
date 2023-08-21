<?php

namespace App\Virtual;

/**
 * @OA\Schema(
 *      schema="ForgetPasswordRequest",
 *      title="Forget Password Request",
 *      description="Forget Password Request and a email link generate for password change",
 *      type="object",
 *      required={"email"}
 * )
 */
class ForgetPasswordRequest
{
    /**
     * @OA\Property(
     *      title="email",
     *      description="Email of member",
     *      example="member@gmail.com",
     *      format="email",
     * )
     *
     * @var string
     */
    public $email;
}
