<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        @vite(['resources/js/app.js'])

    </head>
    <body class="w-full">


        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
              <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                  <table class="min-w-full text-left text-sm font-light">
                    <thead
                      class="border-b bg-white font-medium dark:border-neutral-500 dark:bg-neutral-800 dark:text-neutral-100">
                      <tr>
                        <th scope="col" class="px-6 py-4">#ID</th>
                        <th scope="col" class="px-6 py-4">KGS ID</th>
                        <th scope="col" class="px-6 py-4">İSİM</th>
                        <th scope="col" class="px-6 py-4">VARDİYA</th>
                      </tr>
                    </thead>
                    @foreach ($kgsUsersAll as $kgsUser)
                            
                        <tbody>
                        @if ($loop->even)
                            <tr class="border-b bg-neutral-100 dark:border-neutral-500 dark:bg-neutral-900 dark:text-neutral-100">
                                <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $kgsUser->id }}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{ $kgsUser->kgs_id }}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{ $kgsUser->name }}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{ $kgsUser->shift }}</td>
                            </tr>
                        @elseif ($loop->odd)
                            <tr class="border-b bg-white dark:border-neutral-500 dark:bg-neutral-800 dark:text-neutral-100">
                                <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $kgsUser->id }}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{ $kgsUser->kgs_id }}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{ $kgsUser->name }}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{ $kgsUser->shift }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>


    </body>
</html>
