<?
namespace App\Http\LexaViewComposer;
class lexaViewComposer
{
    public function compose(View $view)
    {
        $view('menus',Menu::all());
    }
}
