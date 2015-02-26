<!DOCTYPE html>
<html>
	<head>
		<title>
			<?php echo $title ?> 
		</title>
		<link href="<?php echo $this->asset('css/exception.css') ?>" rel="stylesheet" type="text/css"/>
	</head>
	
	<body>
		<section id="exception">
			<h1>
				<?php echo $title ?> 
			</h1>
			
			<p>
				<?php echo $this->lang('exception.something-wrong') ?>.
				Trace:
			</p>
			
			<ol>
				<?php if ($traces = $exception->getTrace()): ?> 
				<?php foreach (array_reverse($traces) as $trace): ?> 
				<li>
					File: 
					<code>
						<?php echo $trace['file'] ?> 
					</code><br/>
					On line:
					<?php echo $trace['line'] ?><br/>
					Via:
					<code>
						<?php echo $trace['class'] . $trace['type'] . $trace['function'] ?>
					</code>
				</li>
				<?php endforeach; ?> 
				<?php endif; ?>
			</ol>
			
			<p>Запрос:</p>
			<?php if ($request = $container->get('routing.request')): ?> 
			<ul>
				<li>
					Запрашиваемый URL: 
					<code><?php echo $request->getUrl()->getUrl() ?></code><br/>
					HTTP Метод: 
					<code>
						<?php echo $request->getUrl()->getMethod() ?> 
					</code>
				</li>
			</ul>
			<?php endif; ?> 
		</section>
	</body>
</html>