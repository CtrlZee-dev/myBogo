<?php include('./includes/header.php'); ?>


<div class="container-fluid">
    <div class="row">
        <?php include('./includes/sidebar.php'); ?>

        <main id="testimonial" class="col-md-9 ms-sm-auto col-lg-10 px-md-4">


            <div id="manageTestimonials">

                <table class="table table-striped table-hover">
                    <thead>
                        <h2 class="orderh2">Manage Testimonials</h2>
                        <tr>
                            <th scope="col">Order ID</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Total</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">12345</th>
                            <td>John Doe</td>
                            <td>2024-05-30</td>
                            <td>Pending</td>
                            <td>$150.00</td>


                            <td>
                                <button type="button" class="btn btn-primary" data-action="view" data-id="12345"> Edit</button>
                                <button type="button" class="btn btn-secondary" data-action="edit" data-id="12345">View</button>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">12346</th>
                            <td>Jane Smith</td>
                            <td>2024-05-29</td>
                            <td>Complete</td>
                            <td>$200.00</td>
                            <td>
                                <button type="button" class="btn btn-primary" data-action="view" data-id="12345"> Edit</button>
                                <button type="button" class="btn btn-secondary" data-action="edit" data-id="12345">View</button>
                            </td>
                        </tr>

                    </tbody>
                </table>

            </div>
            <button type="button" class="btn btn-outline-warning testii">add testimonial</button>


            <div id="testimonialDetails" style="display: none;">
                <h2>Testimonial Details</h2>
                <p><strong>Name:</strong> <span id="detailName"></span></p>
                <p><strong>Photo:</strong> <img id="detailPhoto" src="" alt="Testimonial Photo" style="max-width: 100px;"></p>
                <p><strong>Testimonial:</strong> <span id="detailText"></span></p>
                <p><strong>Rating:</strong> <span id="detailRating"></span></p>
                <p><strong>Date:</strong> <span id="detailDate"></span></p>
            </div>


            <div id="add-testimonial" style="display: none;">
                <h2 class="orderh2">Add Testimonial</h2>
                <form id="testimonial-form">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="photo">Photo:</label>
                        <input type="file" id="photo" name="photo" accept="image/*">
                    </div>

                    <div class="form-group">
                        <label for="testimonial">Testimonial:</label>
                        <textarea id="testimonial" name="testimonial" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="rating">Rating:</label>
                        <select id="rating" name="rating">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="date">Date:</label>
                        <input type="date" id="date" name="date" required>
                    </div>

                    <button type="submit">Submit</button>
                </form>
            </div>

        </main>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const testimonials = [{
                name: 'John Doe',
                photo: 'photo1.jpg',
                testimonialText: 'Great service!',
                rating: '5',
                date: '2024-05-01'
            },
            {
                name: 'Jane Smith',
                photo: 'photo2.jpg',
                testimonialText: 'Loved it!',
                rating: '4',
                date: '2024-04-21'
            },
            {
                name: 'Alice Johnson',
                photo: 'photo3.jpg',
                testimonialText: 'Amazing experience.',
                rating: '5',
                date: '2024-03-15'
            },
            {
                name: 'Bob Brown',
                photo: 'photo4.jpg',
                testimonialText: 'Very satisfied.',
                rating: '4',
                date: '2024-02-10'
            }
        ];

        const formTitle = document.getElementById('formTitle');
        const testimonialForm = document.getElementById('testimonialFormDetails');
        const testimonialTable = document.querySelector('#testimonialTable tbody');
        const detailName = document.getElementById('detailName');
        const detailPhoto = document.getElementById('detailPhoto');
        const detailText = document.getElementById('detailText');
        const detailRating = document.getElementById('detailRating');
        const detailDate = document.getElementById('detailDate');
        let editingIndex = null;

        // Function to render testimonials list
        const renderTestimonials = () => {
            testimonialTable.innerHTML = '';
            testimonials.forEach((testimonial, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
            <td>${testimonial.name}</td>
            <td>${testimonial.date}</td>
            <td>
              <button onclick="viewTestimonial(${index})">View</button>
              <button onclick="editTestimonial(${index})">Edit</button>
            </td>
          `;
                testimonialTable.appendChild(row);
            });
        };

        // Function to add or edit testimonial
        testimonialForm.addEventListener('submit', (event) => {
            event.preventDefault();
            const formData = new FormData(testimonialForm);
            const testimonialData = {
                name: formData.get('name'),
                photo: formData.get('photo'), // Handle photo upload appropriately
                testimonialText: formData.get('testimonialText'),
                rating: formData.get('rating'),
                date: formData.get('date'),
            };

            if (editingIndex !== null) {
                testimonials[editingIndex] = testimonialData;
                editingIndex = null;
            } else {
                testimonials.push(testimonialData);
            }

            testimonialForm.reset();
            formTitle.textContent = 'Add Testimonial';
            renderTestimonials();
        });

        // Function to view testimonial
        window.viewTestimonial = (index) => {
            const testimonial = testimonials[index];
            detailName.textContent = testimonial.name;
            detailPhoto.src = testimonial.photo; // Handle photo URL appropriately
            detailText.textContent = testimonial.testimonialText;
            detailRating.textContent = testimonial.rating;
            detailDate.textContent = testimonial.date;
        };

        // Function to edit testimonial
        window.editTestimonial = (index) => {
            const testimonial = testimonials[index];
            document.getElementById('name').value = testimonial.name;
            // Handle photo upload appropriately
            document.getElementById('testimonialText').value = testimonial.testimonialText;
            document.getElementById('rating').value = testimonial.rating;
            document.getElementById('date').value = testimonial.date;
            editingIndex = index;
            formTitle.textContent = 'Edit Testimonial';
        };

        // Initial render
        renderTestimonials();
    });
</script>