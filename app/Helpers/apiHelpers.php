<?php
use PhpParser\Node\Expr\Cast\Array_;

/*
 * API general error message response
 */
function errorHandler(int $code = 500, string $message = null)
{
    $error = [
        'version' => 'v1',
        'message' => $message,
        'code' => $code,
    ];
    return response()->json($error, $code);
}

/*
 * API un authorized error message response
 */
function unAuthorizedErrorHandler($message = 'Your credentials are incorrect or your account has been blocked by the server administrator.')
{
    $error = [
        'version' => 'v1',
        'message' => $message,
        'code' => 401
    ];
    return response()->json($error, 401);
}

/*
 * API success message response
 */
function successHandler($data, int $code = 200, string $message = null)
{
    
    $response = [
        'data' => $data,
        'version' => 'v1',
        'code' => $code,
        'message' => $message
    ];
    return response()->json($response, $code);
}
/*
 * API Internal server error message response
 */
function serverErrorHandler(\Exception $e, $isStripe = false)
{
    $error = [
        'debug' => (config('app.env') !== 'production') ? array(
            'message' => $e->getMessage(),
            'line' => $e->getLine(),
            'file' => $e->getFile(),
            'code' => $e->getCode(),
            // 'trace' => $e->getTrace(),
        ) : null,
        "message" => (!$isStripe) ? "Unable to process your request at this time because the server encountered an unexpected condition." : $e->getMessage(),
        'version' => 'v1',
        'code' => 500,
    ];
    /**
     * Log message for debug
     */
    logger('Debug message: ' . $e->getMessage());

    return response()->json($error, 500);
}
/*
 * API input validation error message response
 */
function validationErrorHandler($validation_error = null)
{
    $error = [
        "validation_error" => $validation_error,
        'message' => 'Something wrong with URL or parameters',
        'version' => 'v1',
        'code' => 422,
    ];
    return response()->json($error, 422);
}

/*
 * API not found error message response
 */
function notFoundErrorHandler($message = 'Resource not found')
{
    $error = [
        'message' => $message,
        'version' => 'v1',
        'code' => 404,
    ];
    return response()->json($error, 404);
}
/*
 * API not found error message response
 */
function disAllowedFieldHandler($fields)
{
    $error = [
        'message' => disAllowedArray($fields),
        'version' => 'v1',
        'code' => 403,
    ];
    return response()->json($error, 403);
}

function disAllowedArray($array)
{
    $result = [];
    foreach ($array as $key) {
        $result[] = $key . ' field is not allowed';
    }
    return $result;
}
