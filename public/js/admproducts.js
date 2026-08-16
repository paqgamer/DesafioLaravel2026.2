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

    document.getElementById("edit_image").value = "";
    document.getElementById("edit_image_clear").style.display = "none";

    document.getElementById("editProductModal").style.display = "flex";
}

function closeEditModal() {
    document.getElementById("editProductModal").style.display = "none";
}

function openCreateModal() {
    document.getElementById("createProductForm").reset();

    const preview = document.getElementById("create_image_preview");
    preview.src = "";
    preview.style.display = "none";
    document.getElementById("create_image_clear").style.display = "none";

    document.getElementById("createProductModal").style.display = "flex";
}

function closeCreateModal() {
    document.getElementById("createProductModal").style.display = "none";
}

window.onclick = function (event) {
    if (event.target === document.getElementById("editProductModal")) {
        closeEditModal();
    }
    if (event.target === document.getElementById("createProductModal")) {
        closeCreateModal();
    }
};


function setupImagePreview(inputId, previewId, clearBtnId, getOriginalUrl) {
    const input = document.getElementById(inputId);
    const preview = document.getElementById(previewId);
    const clearBtn = document.getElementById(clearBtnId);

    input.addEventListener("change", function (event) {
        const file = event.target.files[0];

        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = "block";
            clearBtn.style.display = "block";
        } else {
            const original = getOriginalUrl();
            preview.src = original;
            preview.style.display = original ? "block" : "none";
            clearBtn.style.display = "none";
        }
    });

    clearBtn.addEventListener("click", function () {
        input.value = "";
        const original = getOriginalUrl();
        preview.src = original;
        preview.style.display = original ? "block" : "none";
        this.style.display = "none";
    });
}

setupImagePreview(
    "edit_image",
    "edit_image_preview",
    "edit_image_clear",
    () => document.getElementById("edit_image_preview").dataset.original || ""
);

setupImagePreview(
    "create_image",
    "create_image_preview",
    "create_image_clear",
    () => "" 
);