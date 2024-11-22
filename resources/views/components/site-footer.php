<footer class="bg-dark text-light py-4 mt-5">
    <div class="container">
        <div class="row">
            <!-- About Us Section -->
            <div class="col-md-4 mb-3">
                <h5>About Us</h5>
                <p>my shop is an e-commerce platform offering a wide variety of products across different categories. We aim to provide the best shopping experience for our customers.</p>
            </div>

            <!-- Quick Links Section -->
            <div class="col-md-4 mb-3">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('categories.index') }}" class="text-light">Categories</a></li>
                    <li><a href="{{ route('cart.index') }}" class="text-light">Cart</a></li>
                    <li><a href="{{ route('home') }}" class="text-light">Home</a></li>
                </ul>
            </div>

            <!-- Contact Information Section -->
            <div class="col-md-4 mb-3">
                <h5>Contact Us</h5>
                <p>Email: support@yourstore.com</p>
                <p>Phone: +1 (234) 567-890</p>
            </div>
        </div>

        <!-- Social Media Section -->
        <div class="text-center mt-4">
            <a href="#" class="text-light mx-2"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="text-light mx-2"><i class="fab fa-twitter"></i></a>
            <a href="#" class="text-light mx-2"><i class="fab fa-instagram"></i></a>
            <a href="#" class="text-light mx-2"><i class="fab fa-linkedin-in"></i></a>
        </div>

        <!-- Copyright -->
        <div class="text-center mt-4">
            <p>&copy; 2024 myshop. All Rights Reserved.</p>
        </div>
    </div>
</footer>
