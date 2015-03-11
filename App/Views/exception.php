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
				Something went wrong. Stack trace:
			</p>
			
			<ol>
				<?php if ($traces = $exception->getTrace()): ?> 
				<?php foreach (array_reverse($traces) as $trace): ?> 
				<li>
					File: 
					<code>
						<?php echo $trace['file'] ?> 
					</code><br/>
					Via:
					<code>
						<?php echo $trace['class'] . $trace['type'] . $trace['function'] ?>
					</code><br/>
					On line:
					<?php echo $trace['line'] ?>
				</li>
				<?php endforeach; ?> 
				<?php endif; ?>
			</ol>
			
			<p>Request:</p>
			<?php if ($request = $container->get('routing.request')): ?> 
			<ul>
				<li>
					Request URL: 
					<code><?php echo $request->getUrl()->getUrl() ?></code><br/>
					HTTP Method: 
					<code>
						<?php echo $request->getUrl()->getMethod() ?> 
					</code>
				</li>
			</ul>
			<?php endif; ?> 
		</section>
	</body>
</html>