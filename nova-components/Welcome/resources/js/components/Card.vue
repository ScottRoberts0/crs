<template>
  <div class="flex justify-center items-centers">
    <div class="w-full max-w-xl">
      <heading class="flex mb-3">Welcome</heading>
      <p
        class="text-90 leading-tight mb-8"
      >These forms are designed to help us understand your communication needs so we may effectively get your message out to your audience. Should you need any help along the way, or you are not sure what to fill out, please call us at 2204 or email Karla karla.neufeld@cschurch.ca.</p>

      <card>
        <table class="w-full" cellpadding="0" cellspacing="0">
          <tr>
            <td class="align-top w-1/2 border-r border-b border-50">
              <router-link :to="{ path: '/resources/projects'}" class="no-underline dim flex p-6">
                <!-- <div class="flex justify-center w-11 flex-no-shrink mr-6">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="40"
                    height="40"
                    viewBox="0 0 40 40"
                  >
                    <path
                      fill="var(--primary)"
                      d="M31.51 25.86l7.32 7.31c1.0110617 1.0110616 1.4059262 2.4847161 1.035852 3.865852-.3700742 1.3811359-1.4488641 2.4599258-2.83 2.83-1.3811359.3700742-2.8547904-.0247903-3.865852-1.035852l-7.31-7.32c-7.3497931 4.4833975-16.89094893 2.7645226-22.21403734-4.0019419-5.3230884-6.7664645-4.74742381-16.4441086 1.34028151-22.53181393C11.0739495-1.11146115 20.7515936-1.68712574 27.5180581 3.63596266 34.2845226 8.95905107 36.0033975 18.5002069 31.52 25.85l-.01.01zm-3.99 4.5l7.07 7.05c.7935206.6795536 1.9763883.6338645 2.7151264-.1048736.7387381-.7387381.7844272-1.9216058.1048736-2.7151264l-7.06-7.07c-.8293081 1.0508547-1.7791453 2.0006919-2.83 2.83v.01zM17 32c8.2842712 0 15-6.7157288 15-15 0-8.28427125-6.7157288-15-15-15C8.71572875 2 2 8.71572875 2 17c0 8.2842712 6.71572875 15 15 15zm0-2C9.82029825 30 4 24.1797017 4 17S9.82029825 4 17 4c7.1797017 0 13 5.8202983 13 13s-5.8202983 13-13 13zm0-2c6.0751322 0 11-4.9248678 11-11S23.0751322 6 17 6 6 10.9248678 6 17s4.9248678 11 11 11z"
                    />
                  </svg>
                </div>-->

                <div>
                  <heading :level="3" class="mb-3">Event Request</heading>
                  <p
                    class="text-90 leading-normal"
                  >For events you have that you want us to upload to the website and promote in various ways</p>
                </div>
              </router-link>
            </td>

            <td class="align-top w-1/2 border-b border-50">
              <router-link :to="{ path: '/resources/projects'}" class="no-underline dim flex p-6">
                <!-- <div class="flex justify-center w-11 flex-no-shrink mr-6">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="44"
                    height="44"
                    viewBox="0 0 44 44"
                  >
                    <path
                      fill="var(--primary)"
                      d="M22 44C9.8497355 44 0 34.1502645 0 22S9.8497355 0 22 0s22 9.8497355 22 22-9.8497355 22-22 22zm0-2c11.045695 0 20-8.954305 20-20S33.045695 2 22 2 2 10.954305 2 22s8.954305 20 20 20zm3-24h5c.3638839-.0007291.6994429.1962627.8761609.5143551.176718.3180924.1666987.707072-.0261609 1.0156449l-10 16C20.32 36.38 19 36 19 35v-9h-5c-.3638839.0007291-.6994429-.1962627-.8761609-.5143551-.176718-.3180924-.1666987-.707072.0261609-1.0156449l10-16C23.68 7.62 25 8 25 9v9zm3.2 2H24c-.5522847 0-1-.4477153-1-1v-6.51L15.8 24H20c.5522847 0 1 .4477153 1 1v6.51L28.2 20z"
                    />
                  </svg>
                </div>-->

                <div>
                  <heading :level="3" class="mb-3">Project Request</heading>
                  <p
                    class="text-90 leading-normal"
                  >Non-event related- Like a brochure for ministry fair or a ministry calendar</p>
                </div>
              </router-link>
            </td>
          </tr>

          <tr>
            <td class="align-top w-1/2 border-r border-b border-50">
              <router-link :to="{ path: '/resources/copies'}" class="no-underline dim flex p-6">
                <!-- <div class="flex justify-center w-11 flex-no-shrink mr-6">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="38"
                    height="38"
                    viewBox="0 0 38 38"
                  >
                    <path
                      fill="var(--primary)"
                      d="M36 4V2H2v6.59l13.7 13.7c.1884143.1846305.296243.4362307.3.7v11.6l6-6v-5.6c.003757-.2637693.1115857-.5153695.3-.7L36 8.6V6H19c-.5522847 0-1-.44771525-1-1s.4477153-1 1-1h17zM.3 9.7C.11158574 9.51536954.00375705 9.26376927 0 9V1c0-.55228475.44771525-1 1-1h36c.5522847 0 1 .44771525 1 1v8c-.003757.26376927-.1115857.51536954-.3.7L24 23.42V29c-.003757.2637693-.1115857.5153695-.3.7l-8 8c-.2857003.2801197-.7108712.3629755-1.0808485.210632C14.2491743 37.7582884 14.0056201 37.4000752 14 37V23.4L.3 9.71V9.7z"
                    />
                  </svg>
                </div>-->

                <div>
                  <heading :level="3" class="mb-3">Copy Request</heading>
                  <p
                    class="text-90 leading-normal"
                  >This is your go to form if you need to print, copy, or reprint anything</p>
                </div>
              </router-link>
            </td>

            <td class="align-top w-1/2 border-b border-50">
              <router-link :to="{ path: '/resources/video'}" class="no-underline dim flex p-6">
                <!-- <div class="flex justify-center w-11 flex-no-shrink mr-6">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="36"
                    height="36"
                    viewBox="0 0 36 36"
                  >
                    <path
                      fill="var(--primary)"
                      d="M4 8C1.790861 8 0 6.209139 0 4s1.790861-4 4-4 4 1.790861 4 4-1.790861 4-4 4zm0-2c1.1045695 0 2-.8954305 2-2s-.8954305-2-2-2-2 .8954305-2 2 .8954305 2 2 2zm0 16c-2.209139 0-4-1.790861-4-4s1.790861-4 4-4 4 1.790861 4 4-1.790861 4-4 4zm0-2c1.1045695 0 2-.8954305 2-2s-.8954305-2-2-2-2 .8954305-2 2 .8954305 2 2 2zm0 16c-2.209139 0-4-1.790861-4-4s1.790861-4 4-4 4 1.790861 4 4-1.790861 4-4 4zm0-2c1.1045695 0 2-.8954305 2-2s-.8954305-2-2-2-2 .8954305-2 2 .8954305 2 2 2zm9-31h22c.5522847 0 1 .44771525 1 1s-.4477153 1-1 1H13c-.5522847 0-1-.44771525-1-1s.4477153-1 1-1zm0 14h22c.5522847 0 1 .4477153 1 1s-.4477153 1-1 1H13c-.5522847 0-1-.4477153-1-1s.4477153-1 1-1zm0 14h22c.5522847 0 1 .4477153 1 1s-.4477153 1-1 1H13c-.5522847 0-1-.4477153-1-1s.4477153-1 1-1z"
                    />
                  </svg>
                </div>-->

                <div>
                  <heading :level="3" class="mb-3">Video Request</heading>
                  <p
                    class="text-90 leading-normal"
                  >Any video related items- like promo videos, life change videos, etc.</p>
                </div>
              </router-link>
            </td>
          </tr>

          <tr>
            <td class="align-top w-1/2 border-r border-b border-50">
              <router-link :to="{ path: '/resources/web_-edits'}" class="no-underline dim flex p-6">
                <!-- <div class="flex justify-center w-11 flex-no-shrink mr-6">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="37"
                    height="36"
                    viewBox="0 0 37 36"
                  >
                    <path
                      fill="var(--primary)"
                      d="M2 27h3c1.1045695 0 2 .8954305 2 2v5c0 1.1045695-.8954305 2-2 2H2c-1.1045695 0-2-.8954305-2-2v-5c0-1.1.9-2 2-2zm0 2v5h3v-5H2zm10-11h3c1.1045695 0 2 .8954305 2 2v14c0 1.1045695-.8954305 2-2 2h-3c-1.1045695 0-2-.8954305-2-2V20c0-1.1.9-2 2-2zm0 2v14h3V20h-3zM22 9h3c1.1045695 0 2 .8954305 2 2v23c0 1.1045695-.8954305 2-2 2h-3c-1.1045695 0-2-.8954305-2-2V11c0-1.1.9-2 2-2zm0 2v23h3V11h-3zM32 0h3c1.1045695 0 2 .8954305 2 2v32c0 1.1045695-.8954305 2-2 2h-3c-1.1045695 0-2-.8954305-2-2V2c0-1.1.9-2 2-2zm0 2v32h3V2h-3z"
                    />
                  </svg>
                </div>-->

                <div>
                  <heading :level="3" class="mb-3">Web Edit Request</heading>
                  <p
                    class="text-90 leading-normal"
                  >Use this if you need an edit to the website or have an idea for the web</p>
                </div>
              </router-link>
            </td>

            <td class="align-top w-1/2 border-b border-50">
              <router-link :to="{ path: '/resources/approvals'}" class="no-underline dim flex p-6">
                <!-- <div class="flex justify-center w-11 flex-no-shrink mr-6">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="36"
                    height="36"
                    viewBox="0 0 36 36"
                  >
                    <path
                      fill="var(--primary)"
                      d="M29 7h5c.5522847 0 1 .44771525 1 1s-.4477153 1-1 1h-5v5c0 .5522847-.4477153 1-1 1s-1-.4477153-1-1V9h-5c-.5522847 0-1-.44771525-1-1s.4477153-1 1-1h5V2c0-.55228475.4477153-1 1-1s1 .44771525 1 1v5zM4 0h8c2.209139 0 4 1.790861 4 4v8c0 2.209139-1.790861 4-4 4H4c-2.209139 0-4-1.790861-4-4V4c0-2.209139 1.790861-4 4-4zm0 2c-1.1045695 0-2 .8954305-2 2v8c0 1.1.9 2 2 2h8c1.1045695 0 2-.8954305 2-2V4c0-1.1045695-.8954305-2-2-2H4zm20 18h8c2.209139 0 4 1.790861 4 4v8c0 2.209139-1.790861 4-4 4h-8c-2.209139 0-4-1.790861-4-4v-8c0-2.209139 1.790861-4 4-4zm0 2c-1.1045695 0-2 .8954305-2 2v8c0 1.1.9 2 2 2h8c1.1045695 0 2-.8954305 2-2v-8c0-1.1045695-.8954305-2-2-2h-8zM4 20h8c2.209139 0 4 1.790861 4 4v8c0 2.209139-1.790861 4-4 4H4c-2.209139 0-4-1.790861-4-4v-8c0-2.209139 1.790861-4 4-4zm0 2c-1.1045695 0-2 .8954305-2 2v8c0 1.1.9 2 2 2h8c1.1045695 0 2-.8954305 2-2v-8c0-1.1045695-.8954305-2-2-2H4z"
                    />
                  </svg>
                </div>-->

                <div>
                  <heading :level="3" class="mb-3">Approval Request</heading>
                  <p
                    class="text-90 leading-normal"
                  >Do you have a design we did not create you would like to use? Upload it here, and we will let you know if it needs to be tweaked to represent CSC adequately</p>
                </div>
              </router-link>
            </td>
          </tr>
          <tr>
            <td class="align-top w-1/2 border-r border-b border-50">
              <router-link :to="{ path: '/resources/staffnets'}" class="no-underline dim flex p-6">
                <!-- <div class="flex justify-center w-11 flex-no-shrink mr-6">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="37"
                    height="36"
                    viewBox="0 0 37 36"
                  >
                    <path
                      fill="var(--primary)"
                      d="M2 27h3c1.1045695 0 2 .8954305 2 2v5c0 1.1045695-.8954305 2-2 2H2c-1.1045695 0-2-.8954305-2-2v-5c0-1.1.9-2 2-2zm0 2v5h3v-5H2zm10-11h3c1.1045695 0 2 .8954305 2 2v14c0 1.1045695-.8954305 2-2 2h-3c-1.1045695 0-2-.8954305-2-2V20c0-1.1.9-2 2-2zm0 2v14h3V20h-3zM22 9h3c1.1045695 0 2 .8954305 2 2v23c0 1.1045695-.8954305 2-2 2h-3c-1.1045695 0-2-.8954305-2-2V11c0-1.1.9-2 2-2zm0 2v23h3V11h-3zM32 0h3c1.1045695 0 2 .8954305 2 2v32c0 1.1045695-.8954305 2-2 2h-3c-1.1045695 0-2-.8954305-2-2V2c0-1.1.9-2 2-2zm0 2v32h3V2h-3z"
                    />
                  </svg>
                </div>-->

                <div>
                  <heading :level="3" class="mb-3">Staffnet Request</heading>
                  <p
                    class="text-90 leading-normal"
                  >Would like something uploaded/changed on staffnet?</p>
                </div>
              </router-link>
            </td>

            <td class="align-top w-1/2 border-b border-50"></td>
          </tr>
        </table>
      </card>
    </div>
  </div>
</template>

<script>
export default {
  name: "Welcome",

  props: {
    card: Object
  }
};
</script>
