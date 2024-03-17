document.getElementById("deleteForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Evitar que el formulario se envíe de manera convencional

    var dni = document.getElementById("dni").value;
    var password = document.getElementById("password").value;

    if (dni.length !== 8 || isNaN(dni)) {
        alert("El número de DNI debe contener exactamente 8 dígitos.");
        return;
    }

    var confirmarEliminar = confirm("¿Está seguro de que desea eliminar la cuenta? Esta acción no se puede deshacer.");

    if (confirmarEliminar) {
        console.log("Confirmar eliminación de cuenta");
        borrarCuenta(dni, password);
    } else {
        console.log("Cancelar eliminación de cuenta");
    }
});

function borrarCuenta(dni, password) {
    console.log(dni, password);

    var formData = new FormData();
    formData.append('user_dni', dni);
    formData.append('user_password', password);


    // Enviar la solicitud al servidor
    fetch("eliminar_usuario.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        // Mostrar el mensaje de respuesta del servidor
        document.getElementById("message").innerText = data.message;
        console.log(data);
        if(data.status === "success") {
            document.getElementById("message").style.color = "green";
        } else {
            document.getElementById("message").style.color = "red";
        }
    })
    
    .catch(error => {
        console.error("Error al eliminar usuario:", error);
        document.getElementById("message").innerText = "Error al eliminar usuario. Por favor, inténtalo de nuevo más tarde.";
        document.getElementById("message").style.color = "red";
    });

}