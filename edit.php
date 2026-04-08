<?php
include 'db_connect.php';

if (!isset($_GET['id'])) {
    header("Location: view_books.php");
    exit();
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM books WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: view_books.php");
    exit();
}

$row = $result->fetch_assoc();
$pageTitle = "Edit Book";
include 'includes/header.php';
?>

<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="glass-card p-4 p-lg-5">
            <div class="d-flex flex-wrap justify-content-between align-items-start mb-4">
                <div>
                    <h2 class="h3 mb-1">Amend Asset Record</h2>
                    <p class="text-muted">Modifying <span class="fw-semibold">"<?php echo htmlspecialchars($row['title']); ?>"</span></p>
                </div>
                <span class="badge-ref mt-2 mt-sm-0">REF #<?php echo $row['id']; ?></span>
            </div>
            <hr class="mb-4">

            <form action="update.php" method="POST" class="needs-validation" novalidate>
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                <div class="row g-4">
                    <div class="col-md-7">
                        <!-- Edit fields -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Full work title</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-bookmark-star"></i></span>
                                <input type="text" name="title" id="editTitle" class="form-control" value="<?php echo htmlspecialchars($row['title']); ?>" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Primary author</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                                <input type="text" name="author" id="editAuthor" class="form-control" value="<?php echo htmlspecialchars($row['author']); ?>" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Acquisition valuation ($)</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" name="price" id="editPrice" class="form-control" value="<?php echo $row['price']; ?>" step="0.01" min="0" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <!-- Live preview card -->
                        <div class="p-4 h-100 preview-card">
                            <h6 class="text-muted small fw-semibold text-uppercase mb-4">Current entry preview</h6>
                            <div class="mb-3">
                                <span class="text-muted small d-block">Title</span>
                                <span class="preview-title fs-5 fw-semibold"><?php echo htmlspecialchars($row['title']); ?></span>
                            </div>
                            <div class="mb-3">
                                <span class="text-muted small d-block">Author</span>
                                <span class="preview-author italic-author"><?php echo htmlspecialchars($row['author']); ?></span>
                            </div>
                            <div>
                                <span class="text-muted small d-block">Value</span>
                                <span class="preview-price price-tag fs-3">$<?php echo number_format($row['price'], 2); ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-3 mt-5">
                    <button type="submit" class="btn btn-primary px-5"><i class="bi bi-save me-2"></i>Update Record</button>
                    <a href="view_books.php" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Live preview update -->
<script>
    document.getElementById('editTitle').addEventListener('input', function() {
        document.querySelector('.preview-title').textContent = this.value || '—';
    });
    document.getElementById('editAuthor').addEventListener('input', function() {
        document.querySelector('.preview-author').textContent = this.value || '—';
    });
    document.getElementById('editPrice').addEventListener('input', function() {
        let val = parseFloat(this.value);
        document.querySelector('.preview-price').textContent = isNaN(val) ? '$0.00' : '$' + val.toFixed(2);
    });
</script>
<!-- Bootstrap validation (same as add_book) -->
<script>
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