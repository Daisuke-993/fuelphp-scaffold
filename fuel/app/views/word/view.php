<h2>Viewing <span class='muted'>#<?php echo $word->id; ?></span></h2>

<p>
	<strong>Content:</strong>
	<?php echo $word->content; ?></p>

<?php echo Html::anchor('word/edit/'.$word->id, 'Edit'); ?> |
<?php echo Html::anchor('word', 'Back'); ?>