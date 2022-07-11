export default class Ajax {
    
    requestHtml(url){
       fetch(url)
       .then(res => res.text())
       .then(this.displayProductsHtml);
    }

    displayProductsHtml(content){
        document.querySelector('.myresult').innerHTML = content;
    }
}

