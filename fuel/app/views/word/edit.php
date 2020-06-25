<h2>Editing <span class='muted'>Word</span></h2>
<br>

<?php echo render('word/_form'); ?>
<p>
	<?php echo Html::anchor('word/view/'.$word->id, 'View'); ?> |
	<?php echo Html::anchor('word', 'Back'); ?></p>
