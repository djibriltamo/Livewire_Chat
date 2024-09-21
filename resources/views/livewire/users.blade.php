<div class="max-w-6xl mx-auto my-16">

    <h5 class="text-center text-5xl font-bold py-3">Utilisateurs</h5>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 p-2 ">

        @foreach ($users as $key=> $user)

            {{-- child --}}
            <div class="w-full bg-white border border-gray-200 rounded-lg p-5 shadow">

                <div class="flex flex-col items-center pb-10">

                    <img src="https://images.unsplash.com/profile-1446404465118-3a53b909cc82?ixlib=rb-0.3.5&q=80&fm=jpg&crop=faces&cs=tinysrgb&fit=crop&h=32&w=32&s=a2f8c40e39b8dfee1534eb32acfa6bc7-{{$key}}" alt="" class="w-24 h-24 mb-2 5 rounded-full shadow-lg">

                    <h5 class="mb-1 text-xl font-medium text-gray-900 " >
                        {{$user->name}}
                    </h5>

                    <span class="text-sm text-gray-500">{{$user->email}} </span>

                    <div class="flex mt-4 space-x-3 md:mt-6">
                        <x-secondary-button>
                            Ajouter un utilisateur
                        </x-secondary-button>

                        <x-primary-button wire:click="message({{$user->id}})" >
                            Message
                        </x-primary-button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>
