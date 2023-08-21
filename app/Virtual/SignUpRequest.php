<?php

namespace App\Virtual;

/**
 * @OA\Schema(
 *      schema="SignupRequest",
 *      title="SignUp Authentication Request",
 *      description="SignUp request body data",
 *      type="object",
 *      required={"name","email","password","password_confirmation"}
 * )
 */
class SignUpRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of member",
     *      example="jon"
     * )
     *
     * @var string
     */
    public $name;

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

    /**
     * @OA\Property(
     *      title="password confirmation",
     *      description="confirm password of member",
     *      example="member123",
     *      minLength=6,
     *      format="password"
     * )
     *
     * @var string
     */
    public $password_confirmation;
}
