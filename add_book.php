<?php
$pageTitle = "Add New Book";
include 'includes/header.php';
?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="glass-card p-4 p-lg-5">
            <div class="mb-4">
                <h2 class="h3 mb-1">Catalog New Asset</h2>
                <p class="text-muted">Enter the bibliographic details below</p>
                <hr class="my-4">
            </div>

            <form action="insert.php" method="POST" class="needs-validation" novalidate>
                <div class="mb-4">
                    <label class="form-label fw-semibold">Full work title</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-bookmark-star"></i></span>
                        <input type="text" name="title" class="form-control" placeholder="e.g. The Great Gatsby" required>
                        <div class="invalid-feedback">Please provide a title.</div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Primary author</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                        <input type="text" name="author" class="form-control" placeholder="e.g. F. Scott Fitzgerald" required>
                        <div class="invalid-feedback">Author is required.</div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Acquisition valuation ($)</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="number" name="price" class="form-control" placeholder="0.00" step="0.01" min="0" required>
                        <div class="invalid-feedback">Enter a valid price.</div>
                    </div>
                </div>

                <div class="d-flex gap-3 mt-5">
                    <button type="submit" class="btn btn-primary px-5"><i class="bi bi-check-circle me-2"></i>Commit Entry</button>
                    <a href="view_books.php" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Bootstrap validation
    (function() {
        'use strict';
        var forms = document.querySelectorAll('.needs-validation');
        Array.prototype.slice.call(forms).forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>

<?php include 'includes/footer.php'; ?>