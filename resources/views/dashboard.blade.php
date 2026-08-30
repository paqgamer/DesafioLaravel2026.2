    <link rel="icon" type="image/x-icon" href="{{ asset('image/favicon.svg') }}">

<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Painel de Controle') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="dashboard-container">
            
            <div class="dashboard-welcome">
                <h2>Olá, {{ Auth::user()->name }} </h2>
                <p>Bem vindo ao seu painel de controle do De$af.io.</p>
            </div>

            <div class="dashboard-grid">
                
                <div class="dashboard-card">
                    <div>
                        <div class="card-header-icon">
                            <div class="icon-wrapper blue">
                            <!-- colocar iconezinho aviadado para  ficar  melhor -->
                        </div>
                            <div class="card-title-group">
                                <h3>Tabela de Produtos</h3>
                                <p>Gestão de Estoque</p>
                            </div>
                        </div>
                        <p class="card-body-text">
                            Gerenciar os produtos do site, alterar, criar e remover.
                        </p>
                    </div>

                    <a href="{{ route('admin.products.index') }}" class="card-action-btn blue">
                        Gerenciar Produtos
                    </a>
                </div>
                <div class="dashboard-card">
                    <div>
                        <div class="card-header-icon">
                            <div class="icon-wrapper blue">
                            <!-- colocar iconezinho aviadado para  ficar  melhor -->
                        </div>
                            <div class="card-title-group">
                                <h3>Tabela de Usuários</h3>
                                <p>Gestão de Usuarios</p>
                            </div>
                        </div>
                        <p class="card-body-text">
                            Gerenciar os Usuarios do site, alterar, criar e remover.
                        </p>
                    </div>

                    <a href="{{ route('admin.users.index') }}" class="card-action-btn blue">
                        Gerenciar Usuários
                    </a>
                </div>
                <div class="dashboard-card">
                    <div>
                        <div class="card-header-icon">
                            <div class="icon-wrapper emerald">
                                <!-- colocar outro  icone aviadado de email -->
                        </div>
                            <div class="card-title-group">
                                <h3>Envio de E-mails</h3>
                                <p>Comunicação com Usuários</p>
                            </div>
                        </div>
                        <p class="card-body-text">
                            Enviar um  email  pra  um  usuario do  site.
                        </p>
                    </div>

                    <a href="{{ route('admin.emails.create') }}" class="card-action-btn emerald">
                        Enviar E-mail 
                    </a>
                </div>

            </div>

        </div>
    </div>
    <x-footer />

</x-app-layout>