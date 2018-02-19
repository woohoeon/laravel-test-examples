<?PHP

namespace App\Http\Commands\Example;

use App\Http\Commands\Common\AbstractListCommand;

class ListExampleCommand extends AbstractListCommand
{
    /**
     * ページビルド処理
     *
     * @return array
     */
    public function build()
    {
        //
    }
    
    /**
     * Validationチェック
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data)
    {
        //
    }

    /**
     * Failed Validation処理
     * 
     * @param \Illuminate\Contracts\Validation\Validator
     * @return \Illuminate\Http\Response
     */
    public function failedValidation($validator)
    {
        //
    }

    /**
     * Success Validation処理
     * 
     * @return \Illuminate\Http\Response
     */
    public function successValidation()
    {
        //
    }

    /**
     * query実行の前の処理を定義します。
     *
     * @return boolean query実行有無
     */
    public function confirm()
    {
        //

        return true;
    }

    /**
     * queryを定義します。
     *
     * @return Object execute result
     */
    public function createQuery()
    {
        return $this->getEloquent()::paginate(15);
    }

    /**
     * query実行の後の処理を定義します。
     */
    public function after()
    {
        //
    }
}
