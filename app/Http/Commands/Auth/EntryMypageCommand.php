<?PHP

namespace App\Http\Commands\Auth;

use App\Http\Commands\Common\AbstractEntryCommand;
use Illuminate\Support\Facades\Validator;

class EntryMypageCommand extends AbstractEntryCommand
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
        $originEmail = $this->getEloquent()::where('id', $data['id'])->value('email');

        $emailVaildation = 'required|string|email|max:255';

        if ($originEmail !== $data['email']) {
            $emailVaildation .= '|unique:users';
        }

        return Validator::make($data, [
            'name' => 'required|string|max:255|min:3',
            'email' => $emailVaildation,
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
            ->route('showUserProfile')
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
        $request = $this->getRequest();

        return $this->getEloquent()::where('id', $request->id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
    }

    /**
     * query実行の後の処理を定義します。
     */
    public function after()
    {
        $this->setRedirect(function () {
            return redirect('/');
        });
    }
}
