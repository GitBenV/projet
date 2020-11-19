function wopen()
{
    console.log("la finetre a bien ouverte");
    document.title = "mon titre";
    window.open('login.html.twig');
    document.getElementById("titre").innerText= "Ghange titre";
}