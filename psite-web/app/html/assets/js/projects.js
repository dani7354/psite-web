const projectContainer = $("#projects");
const nextButton = $("#next-button");
const pageSize = 6;

var nextPage = 1;

function insertProject(project) {
    let html = "";
    html += `<div class="col mb-4 d-flex align-items-stretch">`;
    html += `<div class="card">`;
    html += `<div class="card-body">`;
    if (project.image !== null) {
        html += `<img class="card-img-top" src="${project.image}" alt="${project.title}">`; // TODO: give full image path from backend!
    }
    html += `<h5 class="card-title">${project.title}</h5>`;
    html += `<p class="card-text">${project.description}</p>`;
    html += `<a href="${project.url}" class="btn btn-primary">Se mere</a>`;
    html += `</div>`;
    html += `</div>`;
    html += `</div>`;

    projectContainer.append(html);
}

function getProjects(page_number, page_size) {
    let url = `/projects/paginate.php?page_number=${page_number}&page_item_count=${page_size}`;
    $.ajax(url, {
        "method" : "GET",
        "dataType": "json",
        "success" : function (result, status, xhr) {
            return result;
        },
        "error" : function (error) {
            console.log(error);
        }
    });
}

function loadNext(pageNumber, pageSize) {
    let projectPage = getProjects(pageNumber, pageSize);
    nextPage = projectPage["next_page_number"];

    $.each(projectPage["projects"], function (project) {
        insertProject(project);
     });

    nextButton.prop("disabled", (nextPage === null));
}

$(document).ready(function () {
    loadNext(nextPage, pageSize);
});

nextButton.click(function () {
    if(nextPage !== null) {
        loadNext(nextPage, pageSize);
    }
});
