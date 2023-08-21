<?php

namespace App\Virtual;

/**
 * @OA\Schema(
 *      schema="SignInRequest",
 *      title="SignIn Authentication Request",
 *      description="SignIn request body data",
 *      type="object",
 *      required={"email","password"}
 * )
 */
class SignInRequest
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

    /**
     * @OA\Property(
     *      title="password",
     *      description="password of member",
     *      example="member123",
     *      minLength=6,
     *      format="password"
     * )
     *
     * @var string
     */
    public $password;
}
