<link rel="icon" type="image/x-icon" href="{{ asset('image/favicon.svg') }}">

<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Painel de Controle') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="dashboard-container">

            <div class="dashboard-welcome">
                <h2>
                    Olá, {{ Auth::user()->name }}
                    @if (Auth::user()->is_admin)
                        <span class="admin-badge">Administrador</span>
                    @endif
                </h2>
                <p>Bem vindo ao seu painel de controle do De$af.io.</p>
            </div>

            <div class="dashboard-grid">

                <div class="dashboard-card">
                    <div>
                        <div class="card-header-icon">
                            <div class="icon-wrapper blue">
                                <span class="material-symbols-outlined">inventory_2</span>
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

                @if (Auth::user()->is_admin)
                    <div class="dashboard-card">
                        <div>
                            <div class="card-header-icon">
                                <div class="icon-wrapper blue">
                                    <span class="material-symbols-outlined">group</span>
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
                                    <span class="material-symbols-outlined">mail</span>
                                </div>
                                <div class="card-title-group">
                                    <h3>Envio de E-mails</h3>
                                    <p>Comunicação com Usuários</p>
                                </div>
                            </div>
                            <p class="card-body-text">
                                Enviar um email pra um usuario do site.
                            </p>
                        </div>

                        <a href="{{ route('admin.emails.create') }}" class="card-action-btn emerald">
                            Enviar E-mail
                        </a>
                    </div>
                @endif

                <div class="dashboard-card">
                    <div>
                        <div class="card-header-icon">
                            <div class="icon-wrapper violet">
                                <span class="material-symbols-outlined">shopping_bag</span>
                            </div>
                            <div class="card-title-group">
                                <h3>Histórico de Compras</h3>
                                <p>Suas Compras</p>
                            </div>
                        </div>
                        <p class="card-body-text">
                            Veja tudo que você já comprou e gere um relatório em PDF por período.
                        </p>
                    </div>

                    <a href="{{ route('purchases.index') }}" class="card-action-btn violet">
                        Ver Compras
                    </a>
                </div>

                <div class="dashboard-card">
                    <div>
                        <div class="card-header-icon">
                            <div class="icon-wrapper amber">
                                <span class="material-symbols-outlined">sell</span>
                            </div>
                            <div class="card-title-group">
                                <h3>Histórico de Vendas</h3>
                                <p>
                                    @if (Auth::user()->is_admin)
                                        Todas as Vendas do Sistema
                                    @else
                                        Suas Vendas
                                    @endif
                                </p>
                            </div>
                        </div>
                        <p class="card-body-text">
                            @if (Auth::user()->is_admin)
                                Acompanhe todas as vendas realizadas na plataforma e gere relatórios em PDF ou XLSX.
                            @else
                                Veja as vendas dos seus produtos e gere um relatório em PDF por período.
                            @endif
                        </p>
                    </div>

                    <a href="{{ route('sales.index') }}" class="card-action-btn amber">
                        Ver Vendas
                    </a>
                </div>

            </div>

        </div>
    </div>

</x-app-layout>
