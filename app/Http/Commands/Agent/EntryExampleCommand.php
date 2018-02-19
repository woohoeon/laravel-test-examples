<?PHP

namespace App\Http\Commands\Example;

use App\Http\Commands\Common\AbstractEntryCommand;
use Illuminate\Support\Facades\Validator;

class EntryExampleCommand extends AbstractEntryCommand
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
        return Validator::make($data, [
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Failed Validation処理
     *
     * @param \Illuminate\Contracts\Validation\Validator
     * @return \Illuminate\Http\Response
     */
    public function failedValidation($validator)
    {
        return redirect()
            ->route('storeEntryExample')
            ->withErrors($validator)
            ->withInput();
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
        $data = $this->getRequest();

        return $this->getEloquent()::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * query実行の後の処理を定義します。
     */
    public function after()
    {
        $this->setRedirect(function () {
            return redirect()->route('home');
        });
    }
}
