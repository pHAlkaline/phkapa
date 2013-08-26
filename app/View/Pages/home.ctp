<?php $this->Html->script('jquery-zoom', false); ?>

<div class="grid_16 actionsContainer">
    <?php if (AuthComponent::user('id')) { ?>
    <div class="grid_16" style="text-align:center" id="PHKAPAHome">

        <div>
            <?php echo $this->Html->link($this->Html->image('PHKAPA_big.png', array('alt' => 'PHKAPA')), '/phkapa', array('class' => 'zoom', 'target' => '_self', 'escape' => false)); ?>
        </div>
        <!--div id="zoomContainer">
            
            

        </div-->

    </div>
    <?php } else { ?>
    <div class="grid_16">
        <h2 id="page-heading">Iniciar Sessão</h2>
        <div class="form ui-widget">
            <form action="/users/login" id="UserLoginForm" method="post" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST"></div>        <fieldset class="ui-corner-all ui-widget-content">
                    <div class="input text required"><label for="UserUsername">Nome de Utilizador</label><input name="data[User][username]" maxlength="8" type="text" id="UserUsername" required="required"></div><div class="input password required"><label for="UserPassword">Palavra Passe</label><input name="data[User][password]" maxlength="8" type="password" id="UserPassword" required="required"></div>
                </fieldset>
                <div class="submit"><input type="submit" value="Iniciar Sessão" class="ui-button ui-widget ui-state-default ui-corner-all" role="button" aria-disabled="false"></div></form>    </div>

    </div>
    <?php } ?>
    <div class="clear"></div>

</div>
