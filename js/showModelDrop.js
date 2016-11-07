function enableSelect()
{
    if (document.getElementById("makeSelect").value === "anyMake") {
        document.getElementById("modelSelect").disable=true;
    } else {
        document.getElementById("modelSelect").disable=false;
    }
}