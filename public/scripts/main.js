const btnBuys = document.querySelectorAll('.buy');
const product_container = document.querySelector('.product-container');
const addToCartBtn = document.querySelectorAll('.cart');
const cartLogo = document.getElementById('cart-logo')

// const csrf_token = document.getElementById('csrfToken').content;

product_container.addEventListener('click', (event) => {
    buyNow(event)
    addToCart(event)
    deleteCart(event)
    counter(event)

})

function buyNow(event) {
    if (event.target && event.target.classList.contains('buy')) {
        const parentTarget = event.target.closest('.card')
        const price_id = parentTarget.querySelector('.price').getAttribute('data-stripe_price_id')
        const quantity = parentTarget.querySelector('.quantity').textContent;
        const csrf_token = document.getElementById('csrfToken').content;

        // console.log([price_id, quantity])
        const data ={
            'price_id': price_id,
            'quantity': quantity
        }

        const url = 'product-checkout'
        async function buyNowRequest() {

            let request = await fetch(url, {
                method: 'POST',
                body: JSON.stringify(data),
                headers: { 'Content-Type': 'application/json' },
                headers: { 'X-CSRF-TOKEN': csrf_token }
            });

            let response = await request.json();

            // console.log(response)
            window.location.href = response.redirect_url
        } buyNowRequest()


    }
}

function addToCart(event) {
    if (event.target && event.target.classList.contains('cart-btn')) {
        const parentTarget = event.target.closest('.card');
        const productName = parentTarget.querySelector('.product-name').textContent;
        const productPath = parentTarget.querySelector('.src').getAttribute('src');
        const productPrice = parentTarget.querySelector('.price').textContent;
        const productPrice_id = parentTarget.querySelector('.price').getAttribute('data-stripe_price_id');
        const productID = event.target.getAttribute('data-id');
        //  console.log([productName, productID, productPrice, productPath,productPrice_id])

        const csrf_token = document.getElementById('csrfToken').content;
        //ajax request
        const data = {
            name: productName,
            price_id: productPrice_id,
            price: productPrice,
            path: productPath,
            product_id: productID
        }
        //  console.log(data)

        async function addToCartRequest() {

            const url = '/product/cart/create'
            let request = await fetch(url, {
                method: 'POST',
                body: JSON.stringify(data),
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf_token,
                },
            });


            let response = await request.json();
            // console.log(response)
            if (response.status) {
                document.getElementById("message").textContent = 'cart added successfully.'
                document.getElementById("my_modal_1").showModal()
            }

            localStorage.setItem('numberOfCart', response.numberOfCarts)
            updateNumberOfCart()
        } addToCartRequest()


    }
}





function updateNumberOfCart() {
    const cart_indicator = document.getElementById('cart-indicator')
    if (!cart_indicator) {
        return false
    }
  
    cart_indicator.textContent = localStorage.getItem('numberOfCart');
} updateNumberOfCart()

function isCartLogoClicked() {
    if (!cartLogo) {
        return false
    }
    const csrf_token = document.getElementById('csrfToken').content;
    cartLogo.addEventListener('click', () => {
        console.log('yes')
        async function getCartRequest() {

            const url = '/cart'
            let request = await fetch(url, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf_token,
                },
            });


            window.location.href = '/cart';
        } getCartRequest()
    })
} isCartLogoClicked() 

function deleteCart(event) {
    if (event.target && event.target.classList.contains('delete')) {
        const cartToDeleteID = event.target.getAttribute('data-stripe_price_id')
        // console.log(cartToDeleteID);

        const csrf_token = document.getElementById('csrfToken').content;
        async function deleteCartRequest() {

            const url = `product/cart/${cartToDeleteID}/delete`
            let request = await fetch(url, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf_token,
                },
            });


            let response = await request.json();
            // console.log(response)
            if (response.status) {
                document.getElementById("message").textContent = 'cart deleted successfuly.'
                document.getElementById("my_modal_1").showModal()
            }
            localStorage.setItem('numberOfCart', response.numberOfCarts)
            updateNumberOfCart()

            document.querySelector('.btn-modal').addEventListener('click', ()=>{
                window.location.reload();
            })
        } deleteCartRequest()

    }
}


function counter(event) {
    function increament(event) {
        if (event.target && event.target.classList.contains('increament')) {
            const parentTarget = event.target.closest('.card');
            let countTarget = parentTarget.querySelector('.quantity').innerHTML
            parentTarget.querySelector('.quantity').innerHTML =Number(countTarget) + 1
            //update the price
           const price = parentTarget.querySelector('.price').getAttribute('data-price') ;
           const quantity = parentTarget.querySelector('.quantity').innerHTML
           
           parentTarget.querySelector('.price').innerHTML = (Number(price) * Number(quantity)).toFixed(2)

           //cartpage total price features
           const totalPrice = document.querySelector('.total-price');
           const totalPriceContent = totalPrice.innerHTML;
           totalPrice.innerHTML = (Number(totalPriceContent) + Number(price)).toFixed(2);
           console.log(totalPrice.innerHTML);

           //update the quantity in database
           
           const csrf_token = document.getElementById('csrfToken').content;
        async function updateQuantityRequest() {
            
            const url =  '/product/cart/quantity/update' ;
            const price = parentTarget.querySelector('.price').getAttribute('data-stripe_price_id');
            const data = {
                 'price_id': price,
                 'quantity': quantity
            }
            let request = await fetch(url, {
                body: JSON.stringify(data),
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf_token,
                },
            });


            // let response = await request.json();
            // console.log(response)

        } updateQuantityRequest()

           //////////////////////////////////////////////////////
        }
    } increament(event)

    
    function decreament(event) {
        if (event.target && event.target.classList.contains('decreament')) {
            const parentTarget = event.target.closest('.card');
            let countTarget = parentTarget.querySelector('.quantity').innerHTML
            if (countTarget == '1') {
                parentTarget.querySelector('.quantity').innerHTML = 1
                const priceAtt = parentTarget.querySelector('.price').getAttribute('data-price')
                 parentTarget.querySelector('.price').innerHTML = priceAtt ;

            }else{
    
                parentTarget.querySelector('.quantity').innerHTML = Number(countTarget) - 1
                            //update the price
           const price = parentTarget.querySelector('.price').innerHTML ;
           const priceAtt = parentTarget.querySelector('.price').getAttribute('data-price')
           
           parentTarget.querySelector('.price').innerHTML = (Number(price) - Number(priceAtt)).toFixed(2)

           //cartpage total price features
           const totalPrice = document.querySelector('.total-price');
           const totalPriceContent = totalPrice.innerHTML;
           totalPrice.innerHTML = (Number(totalPriceContent) - Number(priceAtt)).toFixed(2);
           console.log(totalPrice.innerHTML);

            //update the quantity in database
           
            const csrf_token = document.getElementById('csrfToken').content;
                async function updateQuantityRequest() {
                    
                    const url =  '/product/cart/quantity/update' ;
                    const price = parentTarget.querySelector('.price').getAttribute('data-stripe_price_id');
                    const quantity = parentTarget.querySelector('.quantity').innerHTML;
                    const data = {
                         'price_id': price,
                         'quantity': quantity
                    }
                    let request = await fetch(url, {
                        body: JSON.stringify(data),
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrf_token,
                        },
                    });
        
        
                    // let response = await request.json();
                    // console.log(response)
        
                } updateQuantityRequest()
            }
        }
    } decreament(event)
}


function cartPrices(){
   const totalPrice = document.querySelector('.total-price')
   if (!totalPrice) {
     return false
   }

    const csrf_token = document.getElementById('csrfToken').content;
    async function getAllCartPricesRequest() {

        const url = `/product/cart/prices`
        let request = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf_token,
            },
        });


        let response = await request.json();
        // console.log(response)
        totalPrice.innerHTML = response.message ;

    } getAllCartPricesRequest()
}cartPrices()

function proceedBtn(){
    const proceedBtn = document.querySelector('.proceed');
    if (!proceedBtn) {
        return false ;
    }

    proceedBtn.addEventListener('click', (event)=>{
    
        const csrf_token = document.getElementById('csrfToken').content;
    async function cartCheckoutRequest() {

        const url = '/cart/checkout'
        let request = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf_token,
            },
        });


        let response = await request.json();
        // console.log(response)
        window.location.href =response.redirect_url

    } cartCheckoutRequest()
    })
}proceedBtn()

