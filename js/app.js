$(document).ready(function() {
  // Global Settings
  let edit = false;

  var positivo_negativo=1;
  
  // Testing Jquery
  valores();
  console.log('jquery is working!');
  fetchTasks();
  $('#task-result').hide();
  $("#salida").hide();
  

  
  
let ver = $('input:radio[name=pago]:checked').val();
                          console.log(ver);
                          

                            $("#boton1").on("click", function(){

                                  $("#sacar").show();
                                  $("#ingre").show();
                                  $("#salida").hide();
                     
                             $("#tasks").removeClass("tasks2");
                            
                             
                            positivo_negativo=1;

                            });

                            $("#boton2").on("click", function(){
                              $("#ingre").hide();
                              $("#salida").show();
                              $("#sacar").hide();
                             


                              $("#tasks").addClass("tasks2");
                             positivo_negativo=2;
                            });

                             


                       

  // search key type event
  $('#search').keyup(function() {
    if($('#search').val()) {
      let search = $('#search').val();
      $.ajax({
        url: 'task-search.php',
        data: {search},
        type: 'POST',
        success: function (response) {
          if(!response.error) {
            let tasks = JSON.parse(response);
            let template = '';
            tasks.forEach(task => {
              template += `
                     <li>Titulo: <a href="#" class="task-item">${task.titulo}</a></li>
                     <li>Fecha: ${task.date}</li>
                     <li>Medio de pago: ${task.pago}</li>
                     <li>Dinero en Tarjeta: ${task.dinero_tarjeta}</li>
                     <li>Dinero en Efectivo: ${task.dinero_efectivo}</li>
                     <li>Dinero que deben: ${task.dinero_deben}</li>
                     <li>Comentario: ${task.description}</li> </br>
                    ` 
            });
            $('#task-result').show();
            $('#container').html(template);
          }
        } 
      });
    }
    else{
      $('#task-result').hide();
    }
  });

    
  $('.task-form').submit(e => {
    e.preventDefault();
    let dinero_tarjetaa =$('#pago2').val();
    let dinero_efectivoo =$('#pago').val();
   let dinero = $('#dinero_real').val();
   let deben = $('#dinero_deben').val();
     if ($('input:radio[name=pago]:checked').val()==dinero_tarjetaa) {
             dinero_tarjetaa=dinero;
             dinero_efectivoo="0";
     }
     else{
              dinero_efectivoo=dinero;
              dinero_tarjetaa="0";
     }
      
      if(positivo_negativo<=1){
          deben = $('#dinero_deben').val();
      }
      else{
        deben = "0";
      }
      
      let capi= $('#capital_total').val();
       let tarj = $('#capital_tarjeta').val();
        let efec = $('#capital_efectivo').val();        
      let supu = $('#capital_supuesto').val();   

             

    const postData = {
      titulo: $('#titulo').val(),
      date: $('#date').val(),
     pago: $('input:radio[name=pago]:checked').val(),
      dinero_tarjeta: dinero_tarjetaa,
      dinero_efectivo:  dinero_efectivoo,
      dinero_deben: deben,
      description: $('#description').val(),
              capital: capi,
              tarjeta: tarj,
              efectivo: efec,
              supuesto: supu,
              positivo_negativo: positivo_negativo,
      id: $('#taskId').val()
    };
    const url ='task-add.php';
    console.log(postData, url);
    
    $.post(url, postData, (response) => {
      console.log(response);
      $('.task-form').trigger('reset');
     valores();
      fetchTasks();
      
    });
  });







  // Fetching Tasks
  function fetchTasks() {
    $.ajax({
      url: 'tasks-list.php',
      type: 'GET',
      success: function(response) {
        const tasks = JSON.parse(response);
        let template = '';
        let reemplazo = "";
        tasks.forEach(task => {
          let verificar = `${task.titulo}`;
          console.log(verificar);
          if (verificar=="") {
            alert("No hay nada");


          }else{
        $('.table').replaceWith(reemplazo);
          template += `
                  
                  

                     <tr taskId="${task.id}"><th> ID</th><td>${task.id}</td></tr>
                    <tr> <th>Titulo</th><td><a href="#" class="task-item">
                    ${task.titulo} 
                  </a></td></tr>
            <tr> <th>Fecha</th><td>${task.date}</td></tr>
            <tr> <th>Medio de Pago</th><td>${task.pago}</td></tr>
            <tr><th> Dinero en Tarjeta</th><td>${task.dinero_tarjeta}</td></tr>
             <tr> <th>Dinero en Efectivo</th><td>${task.dinero_efectivo}</td></tr>
            <tr> <th>Dinero que deben</th><td>${task.dinero_deben}</td></tr>
            <tr> <th>Comentario</th><td>${task.description}</td></tr>


                  <tr>
                    <td>

                    <button class="task-delete btn btn-danger">

                     Borrar
                    </button>
                  </td>
                  <td>
                    <button id="task-confirm" class="task-confirm btn btn-succes">
                     
                     Confirmar
                    </button>
                  </td>
                  </tr>
                  </tr>

                `;

          }

          
        });
        $('#tasks').html(template);
      }
    });
  }
   let debe_tarjeta_efectivo=0;
    $(document).on("click", '#deben', function(){

                console.log($('input:radio[name=deben]:checked').val());
                debe_tarjeta_efectivo=1;
                
      });
    $(document).on("click", '#deben2', function(){
console.log($('input:radio[name=deben]:checked').val());
debe_tarjeta_efectivo=2;

      
      });
     
    $(document).on("click", '#task-confirm', (e)=>{

      console.log($(this)[0].activeElement.parentElement.parentElement.children[1]);
      
        const boton = $(this)[0].activeElement.parentElement.parentElement.children[1];
        
        


      
     
 
      $(boton).replaceWith('<td><input type="radio" id="deben" name="deben" value="efectivo">'+
                               '<label for="deben" name="deben1">EFECTIVO</label><br>'+
                              '<input type="radio" id="deben2" name="deben" value="tarjeta">'+
                             ' <label for="deben" name="deben2">TARJETA</label></td><br>'+
                             '<td> <button id="confirmar2" type="submit" class="btn btn-primary btn-block text-center">Pagar</button></td>');

      
   
     

      
    });
  $(document).on("click", '#confirmar2', (e)=>{
    const element = $(this)[0].activeElement.parentElement.parentElement.children[6];
    
      const valor_deben = $(element).attr('debenId');
     const elemento = $(this)[0].activeElement.parentElement.parentElement;
      const id = $(elemento).attr('taskId');
        console.log(valor_deben);
console.log(id);

      if (confirm('Estas segura de que quieres confirmar esta operacion?, lo que te deben en este registro pasara a el Capital Total.')) {
      




       
      const valoress = {
          valor_deben:valor_deben,
          id:id,
    debe_tarjeta_efectivo:debe_tarjeta_efectivo
      };

      $.post('confirm.php', valoress, (response) => {
        console.log(response);
        fetchTasks();
        valores();
      });

    }
      });
//-----

 $(document).on("click","#modificar_valoress" ,function(){
  if(confirm("Segura que quieres modificar los valores totales?")){
                                console.log("boton apretados");
                            let capit= $('#capital_total').val();
                            
                            let tarje = $('#capital_tarjeta').val();
                             let efece = $('#capital_efectivo').val();       
                           let supue = $('#capital_supuesto').val();

                              const modi = {
                            capit :capit,
                            tarje : tarje,
                             efece :efece,       
                           supue : supue
                              };

                          $.post("modificar_valores.php", modi, (response)=>{
                            console.log(response);
                            valores();

                            
                            alert("Modificados Correctamente =)")
                          });
                          }
                        });



//---



  // Get a Single Task by Id 
  $(document).on('click', '.task-item', (e) => {
    const element = $(this)[0].activeElement.parentElement.parentElement;
    const id = $(element).attr('taskId');
    $.post('task-single.php', {id}, (response) => {
      const task = JSON.parse(response);
      $('#titulo').val(task.titulo);
      $('#date').val(task.date);
      $('#pago').val(task.pago);
      $('#dinero_tarjeta').val(task.dinero_tarjeta);
      $('#dinero_efectivo').val(task.dinero_efectivo);
      $('#dinero_deben').val(task.dinero_deben);
      $('#description').val(task.description);
      $('#taskId').val(task.id);
      edit = true;
    });
    e.preventDefault();
  });

  // Delete a Single Task
  $(document).on('click', '.task-delete', (e) => {
    if(confirm('Are you sure you want to delete it?')) {
      const element = $(this)[0].activeElement.parentElement.parentElement;
      const id = $(element).attr('taskId');

      $.post('task-delete.php', {id}, (response) => {
        fetchTasks();
      });
    }
  });

});

