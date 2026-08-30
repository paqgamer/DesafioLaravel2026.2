<link rel="stylesheet" href="{{asset('css/footer.css')}}">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css" />

<footer class="site-footer">
    <div class="footer-content">
        <div class="footer-brand">
            <img src="{{ asset('image/alogodesafio.png') }}" alt="De$afio" height="45" class="footer-logo">
            <p class="footer-joke">
                Feito com laravel sail, se a bolacha é feita de água e sal, o mar é um bolachão? Afinal a tradução de sail é velejar, e a logo do docker é uma <i class="devicon-docker-plain docker-icon"></i> baleia, esse site é pesado como uma baleia, sinta-se à vontade para navegar em um "bolachão" de bugs
            </p>
        </div>
        
        <div class="footer-links">
            <h4>Navegação</h4>
            <ul>
                <li><a href="#">Início</a></li>
                <li><a href="#catalogo">Catálogo de Produtos</a></li>
                <li><a href="#">Minha Conta</a></li>
                <li><a href="#">Carrinho</a></li>
            </ul>
        </div>

        <div class="footer-contact">
            <h4>Fale Conosco</h4>
            <p>Email: contato@codejr.com.br</p>
            <p>Telefone: (32) 99999-9999</p>
            <p>Juiz de Fora, MG</p>
        </div>
    </div>
    <div class="footer-bottom">
        <p> {{ date('Y') }} De$af.io, que de fato é um desafio, um salve à todos da CODE.JR</p>
    </div>
</footer>