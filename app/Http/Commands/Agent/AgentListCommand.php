<?PHP

namespace App\Http\Commands\Agent;

use App\Agent;
use App\Http\Commands\Common\AbstractListCommand;

class AgentListCommand extends AbstractListCommand
{
    /**
     * ページビルド処理
     *
     * @return array
     */


    public function build()
    {
      $atrries = [
                    'company_type' => '企業種別',
                    'company_name' => '企業名',
                    'postal_code' => '郵便番号',
                    'prefecture' => '都道府県',
                    'city' => '市区町村',
                    'address1' => '番地',
                    'address2' => '建物名',
                    'tel' => '電話番号',
                    'fax' => 'FAX番号'
                ];
      return $atrries;
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
