function openEditModal(produto) {
    const form = document.getElementById("editProductForm");
    form.action = `/admin/products/${produto.id}`;

    document.getElementById("edit_name").value = produto.name || "";
    document.getElementById("edit_price").value = produto.price || "";
    document.getElementById("edit_category_id").value =
        produto.category_id || "";
    document.getElementById("edit_description").value =
        produto.description || "";

    const preview = document.getElementById("edit_image_preview");
    const originalImageUrl = produto.image_url ? `/storage/${produto.image_url}` : "";
    preview.src = originalImageUrl;
    preview.dataset.original = originalImageUrl;

    const imageInput = document.getElementById("edit_image");
    imageInput.value = "";
    document.getElementById("edit_image_clear").style.display = "none";

    document.getElementById("editProductModal").style.display = "flex";
}


document.getElementById("edit_image").addEventListener("change", function (event) {
    const preview = document.getElementById("edit_image_preview");
    const clearBtn = document.getElementById("edit_image_clear");
    const file = event.target.files[0];

    if (file) {
        preview.src = URL.createObjectURL(file);
        clearBtn.style.display = "block";
    } else {

        preview.src = preview.dataset.original || "";
        clearBtn.style.display = "none";
    }
});


document.getElementById("edit_image_clear").addEventListener("click", function () {
    const imageInput = document.getElementById("edit_image");
    const preview = document.getElementById("edit_image_preview");

    imageInput.value = ""; 
    preview.src = preview.dataset.original || "";
    this.style.display = "none";
});

function closeEditModal() {
    document.getElementById("editProductModal").style.display = "none";
}

window.onclick = function (event) {
    const modal = document.getElementById("editProductModal");
    if (event.target === modal) {
        closeEditModal();
    }
};