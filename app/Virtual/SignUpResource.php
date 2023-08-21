<?php

namespace App\Virtual;


/**
 * @OA\Schema(
 *     schema="SignUpResource",
 *     title="SignUp",
 *     description="SignUp response data",
 * )
 */


class SignUpResource
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
     *      example="member@gmail.com"
     * )
     *
     * @var string
     */
    public $email;

    /**
     * @OA\Property(
     *      title="token",
     *      description="auth token",
     *      example="1|xxxxxxxxxxxxxxxxxxxxxxxxxxxxxK"
     * )
     *
     * @var string
     */
    public $token;
}
