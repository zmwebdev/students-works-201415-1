//Cargamos el modelo recetas
var Recetas = require('../app/models/recetas');

//Cargamos el modelo usuarios
var User = require('../app/models/user');

var api_key = process.env.API_KEY;


//module.exports es el objeto que se devuelve tras una llamada request
//así podemos usar express y passport pasando como parámetro
module.exports = function(app, passport) {

// RUTAS ===============================================================

	// =====================================
	// PAGINA PRINCIPAL ====================
	// =====================================
	app.get('/', function(req, res) {
		res.render('index.ejs');
	});


	// =====================================
	// REGISTRO ===========================
	// =====================================
	
	//Obtiene los datos del formulario del registro autentificando el usuario
	app.post('/signup', 

		passport.authenticate('local-signup', {

			successRedirect : '/profile', //si los datos son correctos entraremos al perfil
			failureRedirect : '/error' //si hay un error o los datos no son correctos redirecciona a la página principal

		})

	);



	// =====================================
	// LOGIN ===============================
	// =====================================

	//Obtiene los datos del formulario del registro autentificando el usuario
	app.post('/login', 

		passport.authenticate('local-login', {

		successRedirect : '/profile', // si los datos son correctos entraremos al perfil
		failureRedirect : '/error' //si hay un error o los datos no son correctos redirecciona a la página principal
		
	}));


	// =====================================
	// PERFIL ==============================
	// =====================================

	//usamos la función isLoggedIn para verificar que el usario está logueado
	//ya que no queremos que nadie pueda acceder al perfil sin haberse autentificado antes
	app.get('/profile', isLoggedIn, function(req, res) {

		// email info
		
		var domain = 'sandbox30d928b0fd864f9682ebe41b12e4056f.mailgun.org';
		var mailgun = require('mailgun-js')({apiKey: api_key, domain: domain});
		var email = 'foodjoysocial@gmail.com';

		console.log('email '+email);

		// POST /sendmail
		// curl --data "to=<email>, ..." http://localhost:3000/sendmail
		var data = {
		from: 'foodjoysocial@gmail.com',
		to: email,
		subject: 'Nuevo registro',
		text: 'Un nuevo usuario se ha registrado'
		};

		mailgun.messages().send(data, function (error, body) {
		if (error) {
		res.json(error);
		} else {
		console.log(body);
		//res.json(body);
		}
		});

		res.render('profile.ejs', {

			user : req.user // cogemos el usuario de la session gracias a passport y se lo pasamos a la plantilla (profile.ejs)

		
		//Cierre del método render
		});

	//Cierre de la función	
	});


	// =====================================
	// LOGOUT ==============================
	// =====================================
	app.get('/logout', function(req, res) { 

		req.logout(); //usamos req.logout() que nos proporciona passport. Sirve para salir de la sesión de usuario. 

		//Al cerrar la sesión, le redireccionamos a la página principal.
		res.redirect('/');

	//Cierre de la función
	});
	

	// =====================================
	// RECETAS =============================
	// =====================================

	//Mostrar la página para agregarRecetas
	app.get('/agregarRecetas', isLoggedIn, function(req, res) {
		res.render('agregarRecetas.ejs');
	});

	//Añadir un documento a la colección de recetas
	app.post('/agregarRecetas',  isLoggedIn,function(req, res) {

		if(req.body.nombre==""){

			res.render('error.ejs', {
				mensaje: 'El nombre de la receta es vacio'
			});

		}else if(req.body.ingredientes==""){

			res.render('error.ejs', {
				mensaje: 'Una receta DEBE tener al menos UN ingrediente'
			});

		}

		//Creamos una variable para crear un objeto de tipo Recetas
		var recetas = new Recetas ({

			nombre: req.body.nombre,
			ingredientes: req.body.ingredientes

		});


		//Para guardar dicha instancia en la base de datos
		recetas.save(function (err, obj) {

		  	//Si existe un error
			if(err){
				
				//Muestra por consola el error
		    	console.log('ERROR: ' + err);
		    	res.render('error.ejs', {
				mensaje: ''
			});
			}
			else{

				//Muestra el mensaje por consola
  				console.log(obj.nombre + ' ha sido guardada.');
				
				//Muestra el mensaje en la página agregarRecetas.ejs
				res.render('recetaAgregada', {
					
					receta: obj.nombre,
					msg: ' ha sido guardada.'
					
					
				})
			
			//Cierre de else		
			}

		//Cierre del método save
		});		
		
	//Cierre de la función
	});


	//Obtener toda la colección de recetas
	app.get('/listaRecetas', isLoggedIn, function(req, res) {
		
		Recetas.find({},function(err,recetas){
			
			//Si existe un error
			if(err){
				
				//Muestra por consola
				console.log(err);
				res.render('error.ejs', {
				mensaje: err
			});
			}
			else{

				//Muestra el objeto recetas en la plantilla recetas.ejs
				res.render('recetasProfile', {
					
					recetas: recetas
					
				})
			
			//Cierre de else		
			}
		
		//Cierre del find
		});
		
	//Cierre de la función
	});

	//Mostrar la página para borrarRecetas
	app.get('/borrarRecetas', isLoggedIn,function(req, res) {
		res.render('borrarRecetas.ejs');
	});

	
	//Borrar un documento a la colección de recetas
	app.post('/borrarRecetas', isLoggedIn, function(req, res) {


		//Creamos una variable para obtener el nombre del formulario de la receta a eliminar 
		var nombre = req.body.nombre;

		if(nombre==null || nombre==""){
			res.render('error.ejs', {
				mensaje: 'El nombre de la receta es vacio'
			});
		}

		//Para borrar una receta mediante el nombre
		Recetas.remove({nombre: nombre},function (err) {

			//Si no hay error
  			if (!err){

  				//Muestra el mensaje por consola
  				console.log(nombre + ' ha sido eliminada.');

  				//Muestra el mensaje en la página borrarRecetas.ejs
				res.render('recetaBorrada', {
					
					receta: nombre,
					msg: ' ha sido eliminada.'
					
				})
  								

  			}else{
		      
		      	//Muestra por consola el error
		    	console.log('ERROR: ' + err);
		    	res.render('error.ejs', {
				mensaje: ''
			});

		  }


		//Cierre del remove	
		});
		
	//Cierre de la función
	});

	//Mostrar la página para buscarReceta para modificar una receta
	app.get('/modificarRecetas', isLoggedIn, function(req, res) {
		res.render('buscarReceta.ejs');
	});

	//Obtener un documento de la colección de recetas
	app.post('/modificarRecetas', isLoggedIn, function(req, res) {


		//Creamos una variable para obtener el nombre del formulario de la receta a obtener
		var nombre = req.body.nombre;

		if(nombre==null || nombre==""){
			res.render('error.ejs', {
				mensaje: 'El nombre de la receta es vacio'
			});
		}

		//Para borrar una receta mediante el nombre
		Recetas.findOne({nombre: nombre}, function (err, receta) {

			//Si no hay error
  			if (!err){

  				//Mostramos un mensaje por consola
  				console.log(nombre + ' va a ser modificada.');

  				if(receta==null){
  					console.log("No existe la receta "+receta);
  					res.render('error.ejs', {
				mensaje: 'Esa receta no existe'
			});
  				}else{

  					//Muestra el objeto receta en la página modificarRecetas.ejs
				res.render('modificarRecetas', {
					
					receta: receta
					
					
				})

  				}

				

  			}
  			else{
		      
		      	//Muestra por consola el error
		    	console.log('ERROR: ' + err);
		    	res.render('error.ejs', {
				mensaje: err
			});
			}


		//Cierre del findOne	
		});
		
	//Cierre de la función
	});


	//Modificar un documento de la colección de recetas
	app.post('/recetaModificada', isLoggedIn, function(req, res) {

		//Guardamos los datos obtenidos desde el formulario en las variables a modificar
		var nombre= req.body.nombre;
		var ingredientes= req.body.ingredientes;

		Recetas.update({nombre: nombre}, { nombre: nombre, ingredientes: ingredientes}, null, function (err) {

			//Si hay error
			if (err){
				
		      	//Muestra por consola el error
		    	console.log('ERROR: ' + err);
		    	res.render('error.ejs', {
				mensaje: err
			});
		    }
		    else{

		    	//Muestra el mensaje por consola
		    	console.log(nombre+" ha sido modificada.");

		    	//Muestra el mensaje y los datos de la receta en la página recetaModificada.ejs
				res.render('recetaModificada', {
					
					receta: nombre,
					msg: ' ha sido modificada con los siguientes datos:',
					nombre: nombre,
					ingredientes: ingredientes
					
					
				})

			//Cierre del else	
		    }

		//Cierre del método update
		});
		
	//Cierre de la función
	});




	// =====================================
	// ADMIN ===============================
	// =====================================

	//Panel del administrador
	app.get('/admin', isLoggedIn, function(req, res) {
		res.render('admin.ejs');
	});


	//Usuarios =============================
	//Obtener el número de usuarios
	app.get('/admin/usuarios', isLoggedIn, function(req, res) {

		User.count({}, function(err,count){

		    console.log("Numero de usuarios:", count);

		    User.find({}, function(err,user){

		    	res.render('usuarios', {
					
						usuarios: count,
						usuario: user
				
				//Cierre de la función render		
				})

		    //Cierre de la función find			
		    });


		//Cierre del método count   
		})

	
	//Cierre de la función	
	});

	//Borrar un documento a la colección de usuarios
	app.post('/borrarUsuarios', isLoggedIn, function(req, res) {

		//Creamos una variable para obtener el id del formulario de usuario a eliminar 
		var id= req.body.id;

		//Para borrar un usuario mediante el id
		User.remove({_id: id},function (err) {

			//Si no hay error
  			if (!err){

  				//Muestra el mensaje por consola
  				console.log(id + ' ha sido eliminado.');

  				//Muestra el mensaje en la página borrarUsuarios.ejs
				res.render('usuarioBorrado', {
					
					usuario: id,
					msg: ' ha sido eliminada.'
					
				})
  								

  			}else{
		      
		      	//Muestra por consola el error
		    	console.log('ERROR: ' + err);
		    	res.render('error.ejs', {
				mensaje: ''
			});

		  }


		//Cierre del remove	
		});
		
	//Cierre de la función
	});


	//Recetas  =============================
	//Obtener el número de las recetas
	app.get('/admin/recetas', isLoggedIn, function(req, res) {

		Recetas.count({}, function( err, count){

		    console.log( "Numero de recetas:", count );

		    Recetas.find({}, function(err,receta){

		    	res.render('recetasAdmin', {
					
						recetas: count,
						receta: receta
				
				//Cierre de la función render		
				})

		    //Cierre de la función find			
		    });

		//Cierre del método count 
		})
		
	//Cierre de la función
	});

	//Eliminar un documento a la colección de recetas
	app.post('/eliminarRecetas', isLoggedIn, function(req, res) {

		//Creamos una variable para obtener el id del formulario de receta a eliminar 
		var id= req.body.id;

		//Para borrar un usuario mediante el id
		Recetas.remove({_id: id},function (err) {

			//Si no hay error
  			if (!err){

  				//Muestra el mensaje por consola
  				console.log(id + ' ha sido eliminado.');

  				//Muestra el mensaje en la página borrarUsuarios.ejs
				res.render('recetaEliminada', {
					
					receta: id,
					msg: ' ha sido eliminada.'
					
				})
  								

  			}else{
		      
		      	//Muestra por consola el error
		    	console.log('ERROR: ' + err);
		    	res.render('error.ejs', {
				mensaje: ''
			});

		  }


		//Cierre del remove	
		});
		
	//Cierre de la función
	});

	app.post('/mail', isLoggedIn, function(req, res){

		// email info
		var api_key = 'key-11cfde82cdbb7bb9b3f575fc956f79f1';
		var domain = 'sandbox30d928b0fd864f9682ebe41b12e4056f.mailgun.org';
		var mailgun = require('mailgun-js')({apiKey: api_key, domain: domain});
		var email = req.body.email2;

		// POST /sendmail
		// curl --data "to=<email>, ..." http://localhost:3000/sendmail
		var data = {
		from: 'foodjoysocial@gmail.com',
		to: email,
		subject: 'Hello',
		text: 'Testing some Mailgun awesomness!'
		};

		mailgun.messages().send(data, function (error, body) {
		if (error) {
		res.json(error);
		} else {
		console.log(body);
		res.json(body);
		}
		});
	});//cierre mail

	app.get('/error', isLoggedIn, function(req, res) { 

		//si hay un error se renderiza una página que dice ERROR
		res.render('error.ejs', {
				mensaje: ''
			});

	//Cierre de la función
	});

//Cierre del module.exports
};



//Función para saber si aún sigue logueado
//Un usuario tiene que estar conectado para tener acceso a esta ruta. 
function isLoggedIn(req, res, next) {

	//si el usuario está logueado continuar
	if (req.isAuthenticated())
		return next();

	//si el usuario no está logueado y trata de acceder, redireccionamos a la página principal
	res.render('error.ejs', {
				mensaje: 'No estás logueado, no puedes acceder a esta página'
			});

//Cierre de la función isLoggedIn
}