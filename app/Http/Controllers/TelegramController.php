<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use NotificationChannels\Telegram\{TelegramUpdates, TelegramMessage, TelegramPoll, TelegramContact, TelegramLocation, TelegramFile};

class TelegramController extends Controller
{
    // my telegram ID : 5813584952
    public function updates(){
        $updates = TelegramUpdates::create()
        // (Optional). Get's the latest update. NOTE: All previous updates will be forgotten using this method.
        // ->latest()
        
        // (Optional). Limit to 2 updates (By default, updates starting with the earliest unconfirmed update are returned).
        ->limit(2)
        
        // (Optional). Add more params to the request.
        // ->options([
        //     'timeout' => 3600,
        // ])
        ->get();

        $latest = TelegramUpdates::create()->latest()->get();
        if($updates['ok']) {
            // Chat ID
            $chat = $updates['result'];

            dd(
                $chat,
                $updates['result'],
                $latest,
            );
        }
    }

    
    public function sendMessage()
    {
        $exportPdf = route('export.users.pdf');
        $exportExcel = route('export.users.excel');

        $someUsers = User::take(5)->get();

        $immortalLoveArray = [
            'Her canlı seni birgün terk edebilir ama ben senden daha uzun yaşayacağım. Sen beni terk edene kadar seni asla terk etmeyeceğim.',
        ];
        // $contactList = [1409035025,5182248763,5919177405,6211546136,5829330721,5813584952];
        // foreach ($contactList as $contact) {
        // /*
        TelegramMessage::create()
            // Optional recipient user id.
            ->to(5813584952)
            // ->to($contact)
            // Markdown supported.
            ->line("Merhabalar ben Invamed IT ekibinden Anıl Demirbaş;")
            ->line("")
            ->line("https://portal.rdglobal.com.tr da desteğe ihtiyacınız olduğunda bana bu numaradan ulaşabilirsiniz.")

            // (Optional) Inline Buttons
            // ->button('Export as PDF', $exportPdf)
            // ->button('Export as Excel', $exportExcel)

            // (Optional) Inline Button with callback. You can handle callback in your bot instance
            // ->buttonWithCallback('Confirm', 'test')
            ->send();
        // */

        /*
        TelegramMessage::create()
            // ->to(env('BOT_LOVE_CHANNEL_ID'))
            ->to(5813584952)

            ->line($immortalLoveArray[array_rand($immortalLoveArray)])

            // (Optional) Inline Buttons
            // ->button('Export as PDF', $exportPdf)
            // ->button('Export as Excel', $exportExcel)

            // (Optional) Inline Button with callback. You can handle callback in your bot instance
            // ->buttonWithCallback('Confirm', 'test')
            ->send();
        */

        /*
        TelegramPoll::create()
            // ->to(5813584952)
            // ->to(1065716622)
            ->to(env('BOT_LOVE_CHANNEL_ID'))
            ->question("Do you love me?")
            ->choices(['Yes', 'Not Sure', 'No'])
            ->send();
        */

        // /*
        TelegramContact::create()
            ->to(5813584952)
            // ->to($contact)
            ->firstName('Anıl')
            ->lastName('Demirbaş') // Optional
            ->phoneNumber('90 538 450 81 64')
            ->send();

        // */


        /*
        TelegramLocation::create()
            ->to(5813584952)
            // ->to(1065716622)
            ->latitude('39.800747')
            ->longitude('32.460466')
            ->send();
        */


        /*
        TelegramFile::create()
            ->to(5813584952)
            // ->to(1065716622)
            // ->content('Awesome *bold* text and [inline URL](http://www.example.com/)')
            // ->file('/storage/archive/6029014.jpg', 'photo'); // local photo
    
            // OR using a helper method with or without a remote file.
            ->photo('https://www.wallpaperflare.com/static/232/249/104/heart-digital-art-red-fire-wallpaper-preview.jpg')
            ->send();
        */
        // }

        return redirect()->back();
    }
}
