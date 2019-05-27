<?php
$pontos = "";
if (realpath("./index.php")) {
    $pontos = './';
} else {
    if (realpath("../index.php")) {
        $pontos = '../';
    } else {
        if (realpath("../../index.php")) {
            $pontos = '../../';
        }
    }
}
?>

<div id="modal1" class="modal">
    <div class="modal-content">
      <h4>Olá, obrigado por entrar em contato!</h4>
      <p>Um e-mail foi encaminhado com seus dados e sua mensagem, retornaremos o contato assim que possível!</p>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Ok</a>
    </div>
  </div>

<div class="caixacontato z-depth-4" hidden="true">
    <div class="topocontato center valign-wrapper z-depth-1-half">
        <span class="white-text spancontato">Informe seus Dados!</span>
        <a href="#" class="botaofechar"style="margin-right: 8px; position: absolute; right: 0;"><i class="material-icons right white-text" >close</i></a>
    </div>
    <div class="formcontato">
        <form action="<?php echo $pontos; ?>Controle/contatoControle.php?function=contato" method="post" id="formContato">
            <div class="row">
                <div class="input-field col s12 ">
                    <input class="input-field" type="text" name='nome' id="nome"/>
                    <label for="nome">Nome</label>
                </div>
                <div class="input-field col s12 ">
                    <input class="input-field validate" type="email" name='email' id="email"/>
                    <label for="email">E-mail</label>
                </div>
                <div class="input-field col s12 ">
                    <input class="input-field" type="text" name='telefone' id="telefone"/>
                    <label for="telefone">Telefone</label>
                </div>
                <div class="input-field col s12 ">
                    <textarea class="materialize-textarea" name='mensagem' id="mensagem"></textarea>
                    <label for="mensagem">Sua mensagem</label>
                </div>
                <?php
                if (isset($_GET['apt'])) {
                    echo "<input type='text' name='id_apartamento' hidden='true' value='" . $_GET['apt'] . "'/>";
                } else {
                    echo "<input type='text' name='id_apartamento' hidden='true' value='0'/>";
                }
                ?>
                <div class="col s12 center">
                    <a href="#" class="btn corPadrao3 botaofechar">Cancelar</a>
                    <input type="submit" class="btn corPadrao2" value="Enviar"/>
                </div>
            </div>
        </form>
    </div>
</div>
<a class="btn waves-effect waves-light corPadrao3 right botaocontato"><i class="material-icons left">mode_comment</i><div style="margin: auto auto auto auto;" class="right">Contato</div></a>
<footer class="center corPadrao2">
    <div class="footer-copyright white-text"><a href="http://nobadserver.com" class="center col l10 s12 offset-l1 white-text">
            © 2019 Developed by - Daniel Castro - Daniel Anesi - Lucas Lima - Victor Xavier</a>
    </div>
</footer>

<script>
    $('.botaocontato').click(function () {
        $(this).hide(500);
        $('.caixacontato').show(500);
    });
    $('.botaofechar').click(function () {
        $('.botaocontato').show(500);
        $('.caixacontato').hide(500);
    });
    
    $(document).ready(function(){
    $('.modal').modal();
  });

    $('#formContato').submit(function () {
        var dados = $(this).serialize();
        $.ajax({
            url: './Controle/contatoControle.php?function=contatoJs',
            type: 'POST',
            async: false,
            data: dados,
            success: function (data) {
                if (data == 'true') {
                    $('#nome').val('');
                    $('#email').val('');
                    $('#telefone').val('');
                    $('#mensagem').val('');
                    $('.botaocontato').show(500);
                    $('.caixacontato').hide(500);
                    var instance = M.Modal.getInstance($('#modal1'));
                    instance.open();
                }else{
                    alert('Algo deu errado!' + data);
                }
            }
        });
        return false;
    });
</script>
