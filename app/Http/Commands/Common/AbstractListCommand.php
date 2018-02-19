<?PHP

namespace App\Http\Commands\Common;

abstract class AbstractListCommand extends GlobalCommand
{
    /**
     * ページビルド処理
     * 
     * @return array
     */
    abstract public function build();

    /**
     * Validationチェック
     * 
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    abstract public function validator(array $data);

    /**
     * Failed Validation処理
     * 
     * @param \Illuminate\Contracts\Validation\Validator
     * @return \Illuminate\Http\Response
     */
    abstract public function failedValidation($validator);

    /**
     * Success Validation処理
     * 
     * @return \Illuminate\Http\Response
     */
    abstract public function successValidation();

    /**
     * query実行の前の処理を定義します。
     *
     * @return boolean
     */
    abstract public function confirm();

    /**
     * queryを定義します。
     *
     * @return Object execute result
     */
    abstract public function createQuery();

    /**
     * query実行の後の処理を定義します。
     */
    abstract public function after();

    /**
     * list commandのメインロジックを実行します。
     */
    public function execute()
    {
        $result = false;

        if ($this->confirm()) {
            $this->setQuery(function () {
                return $this->createQuery();
            });
            $result = parent::execute();
            $this->after();
        }

        return $result;
    }

    /**
     * ページビルド用データを設定します。
     */
    public function createAttrValues()
    {
        $this->setAttrValues($this->build());
    }
}
