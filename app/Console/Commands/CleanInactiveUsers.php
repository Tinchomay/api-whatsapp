<?php

namespace App\Console\Commands;

use App\Http\Controllers\PrincipalController;
use App\Models\UserState;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CleanInactiveUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clean-inactive-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Limpia usuarios inactivos y envía un mensaje de despedida si pasaron 2 minutos sin actividad';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $twoMinutesAgo = Carbon::now()->subMinutes(2);

        $inactiveUsers = UserState::where('updated_at', '<', $twoMinutesAgo)->get();

        foreach ($inactiveUsers as $user) {
            $this->sendGoodbyeMessage($user->telefono);

            $user->delete();
        }
    }

    private function sendGoodbyeMessage($telefono)
    {
        $controller = new PrincipalController();
        $controller->enviar($telefono, 'Gracias por usar nuestro sistema. Si necesitas más ayuda, no dudes en contactarnos. ¡Hasta luego!');
    }
}
