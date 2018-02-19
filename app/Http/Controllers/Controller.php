<?php

namespace App\Http\Controllers;

use App\Exceptions\ExecuteException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * getValidator
     *
     * @param $command
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public static function getValidator($command)
    {
        $request = $command->getRequest();

        return $command->validator($request->all());
    }

    /**
     * Validationチェックのみ
     *
     * @param  function  $createCommand
     * @return \Illuminate\Http\Response
     */
    public function validateCommand($createCommand)
    {
        $command = $createCommand();
        $validator = Controller::getValidator($command);

        if ($validator->fails()) {
            return $command->failedValidation($validator);
        } else {
            return $command->successValidation();
        }
    }

    /**
     * DB実行
     *
     * @param  function  $createCommand
     * @return \Illuminate\Http\Response
     */
    public function executeCommand($createCommand)
    {
        $command = $createCommand();

        if ($command->execute()) {
            $redirect = $command->getRedirect();

            if (isset($redirect)) {
                return $redirect();
            } else {
                $command->createAttrValues();

                return ['results' => ['build' => $command->getAttrValues(), 'values' => $command->getResult()]];
            }
        } else {
            throw new ExecuteException();
        }
    }

    /**
     * Validationチェック後、DB実行
     *
     * @param  function  $createCommand
     * @return \Illuminate\Http\Response
     */
    public function validateExecuteCommand($createCommand)
    {
        $command = $createCommand();
        $validator = Controller::getValidator($command);

        if ($validator->fails()) {
            return $command->failedValidation($validator);
        } else {
            return $this->executeCommand($createCommand);
        }
    }

    /**
     * ページビルドのみ
     * 
     * @return \Illuminate\Http\Response
     */
    public function buildCommand($createCommand)
    {
        $command = $createCommand();

        $command->createAttrValues();

        return ['results' => ['build' => $command->getAttrValues()]];
    }
}
