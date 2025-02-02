# -----------------------------------------
# --- Como pretendo obtener mi objetivo ---
# -----------------------------------------


## Objetivo
Tener un botón que al darle, suerte una rifa de donde irá cada peña en una cuadricula de 50x50

## Como llegar a el
Usaré un componente en livewire para hacerlo.
Tendré por lo menos que tener dos métodos;
	
Uno para verificar que coordenadas son validas (como mínimo, las que otras peñas ya tienen).
Y otro para la lógica del sorteo al darle al botón.

Será un botón que al darle ejecutará el método draw, y este ha de hacer las siguientes cosas:
	* Crear un bucle con, las coordenadas xy y una peña aleatoria, y este bucle
	guardará en la base de datos donde irá cada peña.

	Y también obtener la fecha actual de la rifa.



A través de eso, luego se ha de hacer la lógica de pintarlo todo