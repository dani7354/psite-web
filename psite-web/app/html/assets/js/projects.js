const projectContainer = $("#project-container");
const nextButton = $("#next-button");
const pageSize = 6;

let nextPage = 1;

function insertProjects(projects) {
    $.each(projects, function (index, project) {
        insertProject(project);
     });
}

function insertProject(project) {
    let projectDiv = $("<div></div>").addClass("col mb-4 d-flex align-items-stretch");
    let cardDiv = $("<div></div>").addClass("card d-flex flex-column");
    projectDiv.append(cardDiv);
    let cardBodyDiv = $("<div></div>").addClass("card-body");
    cardDiv.append(cardBodyDiv);

    let title = $("<h5></h5>").addClass("card-title");
    let titleLink = $("<a></a>").addClass("link-secondary").attr("href", project.url).text(project.title);
    let iconLink = $("<i></i>").addClass("fa fa-github fa-lg fa-github-project");
    title.append(titleLink);
    title.append(iconLink);
    cardBodyDiv.append(title);

    cardBodyDiv.append($("<p></p>").addClass("card-text").text(project.description));
    if (project.updated_at !== null) {
        cardBodyDiv.append($("<p></p>").addClass("card-text").text(`Senest opdateret: ${project.updated_at}`));
    }

    projectContainer.append(projectDiv);
}

function getProjects(page_number, page_size) {
    let url = `/projects/paginate.php?page_number=${page_number}&page_item_count=${page_size}`;

    $.ajax(url, {
        "method" : "GET",
        "dataType": "json",
        "success" : function (result, status, xhr) {
            insertProjects(result["projects"]);
            nextPage = result["next_page_number"] ?? null;
            nextButton.prop("disabled", nextPage == null);
        },
        "error" : function (error) {
            console.log(error);
        }
    });
}

function loadNext(pageNumber, pageSize) {
    getProjects(pageNumber, pageSize);
}

$(document).ready(function () {
    loadNext(nextPage, pageSize);
});

nextButton.on("click", function () {
    if(nextPage !== null) {
        loadNext(nextPage, pageSize);
    }
    else {
        console.log("All projects are loaded!");
    }
});
