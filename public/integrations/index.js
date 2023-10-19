function formatSalary(amount) {
  const formatter = new Intl.NumberFormat("en-IN", {
    style: "currency",
    currency: "INR",
  });
  const formattedValue = formatter.format(amount);
  let spl = formattedValue.split(",");

  if (spl.length === 2) return spl[0] + "K";
  else if (spl.length === 3) return spl[0] + "Lac";

  return formattedValue;
}
function formatCreated(created) {
  const date = new Date(created);
  const formatter = new Intl.DateTimeFormat("en-US", {
    month: "short", // abbreviated month (e.g., "Nov")
    day: "numeric", // day of the month (e.g., "11")
    year: "numeric", // full year (e.g., "2021")
  });
  const formattedDate = formatter.format(date);
  return formattedDate;
}

let innerHTML = ({
  created,
  position,
  numP,
  minExp,
  maxExp,
  minsal,
  maxsal,
  location,
  jd,
}) => {
  minsal = formatSalary(minsal);
  maxsal = formatSalary(maxsal);
  created = formatCreated(created);
  return ` <div class="job card1 candidateCard">
        <div class="logo">
          <img
            src="data:image/jpeg;base64,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"
            alt=""
          />
          <span class="date">${created}</span>
        </div>
        <div
          class="for d-flex justify-content-between my-3"
          style="position: relative">
          ${
            position.trim().length > 20
              ? `<marquee behavior="smooth" direction="">
                <p>${position}</p>
              </marquee>`
              : `<p>${position}</p>`
          }

          <span class="position">${numP} Positions</span>
        </div>
        <div class="badges my-3">
          <span class="badge text-bg-primary mx-1 px-3">
            ${minExp}y - ${maxExp}y
          </span>
          <span class="badge text-bg-success mx-1 px-3">
            {minsal} - {maxsal}
          </span>
        </div>
        <div class="jd my-3">
          <p
            class="loc"
            style="font-weight: 400; color: "#111"; margin: 0; margin-top: 20"
          >
            ${location}
          </p>
          <p>${jd}...</p>
        </div>
        <div class="btns justify-content-between">
          <button class="focus btn1">Apply</button>
          <button class="focus btn1" onClick="{openModal}">
            About Job
          </button>
        </div>
      </div>`;
};

async function getData() {
  let data = await fetch("https://www.happiestresume.com/api/national", {
    method: "GET",
  });
  let pdata = await data.json();
  console.log(pdata);
  let jobs = document.querySelector("#jobs");
  jobs.innerHTML = "";
  pdata.data.forEach((job) => {
    let data = {
      created: job.created_at,
      position: job.position,
      numP: job.no_of_opening,
      minExp: job.experience_year_from,
      maxExp: job.experience_year_to,
      minsal: job.package_offer_from,
      maxsal: job.package_offer_to,
      location: job.job_location,
      jd: job.job_description.substr(0, 60),
    };
    jobs.innerHTML += innerHTML(data);
  });
}
// getData();
