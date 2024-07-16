{% block form-body %}

<p class="pad-v-1">Sei sicuro di voler uscire?</p>

{% end form-body %}

{% block form-footer %}

<button type="submit" name="submit" class="pbtn">Log Out</button>
<a href="<?= html_link() ?>"class="sbtn">Indietro</a>

{% end form-footer %}