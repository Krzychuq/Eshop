
function alert_message(item){
    item.classList.add("shake");
    item.style.animation = "padaka 0.2s linear 3 both";
    setTimeout(stop_alert_message,3000);
    setTimeout(fadeout,2000);
}
function stop_alert_message(){
    message.style.display = "none";
}
function fadeout(){
    message.style.animation = "fadeout 1s linear 1";
}
