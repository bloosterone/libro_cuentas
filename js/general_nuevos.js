$(document).ready(function(){
	console.log("jquery llega");
	
valores();

let contador=1;
$('#menu').on("click",function(){
		// $('nav').toggle(); 

		if(contador == 1){
			$('.contenedor-navbar').animate({
				top: '30'
			});
			contador = 0;
			console.log(contador);
		} else {
			contador = 1;
			$('.contenedor-navbar').animate({
				top: '-120%'
			});
			console.log(contador);
		}

	});
//fin menu click
   $(document).on('click', '.task-delete', function() {
    
    if(confirm('Are you sure you want to delete it?')) {
      const element = $(this)[0].parentElement.parentElement.parentElement.parentElement.children[0].children[0];
      const id = $(element).attr('taskId');
      console.log(id);

      $.post('../php/task-delete.php', {id}, (response) => {
        console.log(response);
        fetchTasks();
      });
    }
  });


});
//fin jquery ready function

function valores(){
    $.ajax({
      url: '../php/valores.php',
      type: 'GET',
      success: function(response) {
        console.log(response);

  const taskss= JSON.parse(response);   




        // const taskss = (response);
       
        let tem = '';
        let uno;
		let dos;
		let tres;
		let cuatro;
    console.log(uno,dos,tres,cuatro);
        taskss.forEach(task =>{
         uno=task.capital;
         dos=task.tarjeta;
         tres=task.efectivo;
         cuatro=task.supuesto;
        });
        $("#capital_total").val(uno);
		$("#capital_tarjeta").val(dos);
		$("#capital_efectivo").val(tres);
		$("#capital_supuesto").val(cuatro);
      }

    });
}
 //fin funcion valores

 