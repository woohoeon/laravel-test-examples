<?PHP

namespace App\Http\Commands\Common;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

abstract class GlobalCommand
{
    public $request;
    public $eloquent;
    public $routeParameter;
    public $query;
    public $result;
    public $attrValues;
    public $errors;
    public $messages;
    public $redirect;

    public function __construct($request, $eloquent, $routeParameter = null)
    {
        $this->request = $request;
        $this->eloquent = $eloquent;
        $this->routeParameter = $routeParameter;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getEloquent()
    {
        return $this->eloquent;
    }

    public function getRouteParameter()
    {
        return $this->routeParameter;
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function getResult()
    {
        return $this->result;
    }

    public function getAttrValues()
    {
        return $this->attrValues;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function getMessages()
    {
        return $this->messages;
    }

    public function getRedirect()
    {
        return $this->redirect;
    }

    public function setQuery($query)
    {
        $this->query = $query;
    }

    public function setResult($result)
    {
        $this->result = $result;
    }

    public function setAttrValues($attrValues)
    {
        $this->attrValues = $attrValues;
    }

    public function setErrors($errors)
    {
        $this->errors = $errors;
    }

    public function setMessages($messages)
    {
        $this->messages = $messages;
    }

    public function setRedirect($redirect)
    {
        $this->redirect = $redirect;
    }

    /**
     * query実行
     *
     * @return  boolean
     */
    public function execute()
    {
        $query = $this->getQuery();

        if (isset($query)) {
            try {
                $this->setResult($query());
            } catch (QueryException $err) {
                $this->setErrors($err->getMessage());
                Log::error('Failed to execute.', ['errors' => $err->getMessage()]);
                return false;
            }
        } else {
            Log::error('Undefined query.', ['errors' => $err->getMessage()]);
            return false;
        }

        return true;
    }
}
