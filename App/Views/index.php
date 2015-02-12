<section class="pages">
	<h1>
		Главная страница
	</h1>
	
	<ul class="pages">
		<?php foreach (range(1,4) as $range): ?>
		<li>
			<h2>
				Заголовок
				
				<span class="right">
					21.12.2015
				</span>
			</h2>
			
			<p> 
				<a href="#">The animals</a> can't manufacture the amino acid lysine. 
				Unless they're continually supplied with lysine by us, they'll slip into a coma and die.
			</p>
			
			<p> 
				The animals can't manufacture the amino acid lysine. 
				Unless they're <a href="#">continually</a> supplied with lysine by us, they'll slip into a coma and die.
			</p>
			
			<p> 
				The animals can't manufacture the <a href="#">amino acid lysine</a>. 
				Unless they're continually supplied with lysine by us, they'll slip into a coma and die.
			</p>
			
			<p class="info">
				Опублиовал admin
				<span class="right">Категория Тест1</span>
			</p>
		</li>
		<?php endforeach; ?>
	</ul>
<section>
