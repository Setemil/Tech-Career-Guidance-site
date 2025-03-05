<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Afacad+Flux:wght@100..1000&family=Outfit:wght@100..900&display=swap" rel="stylesheet"  />
    <script src="https://kit.fontawesome.com/b0bad06dff.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css" />
    <style>
      .outer-div{
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-start;
      }
      .loginPane, .signUpPane.fade-in{
        position: absolute;
        height: 70%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        margin-top: -50px;
        width: 600px;
      }
      
      .social-icons {
        gap: 10px;
        display: flex;
        justify-content: center; 
        width: 100%;
      }
      .things{
        display: flex;
        gap: 10px;
        align-items: center;
      }
      .error-message {
        color: white;
        background-color: red;
        padding: 10px;
        border-radius: 5px;
        text-align: center;
        margin-top: 10px;
        }
        #moveButton{
          position: absolute;
           bottom: 20px;
           margin-left: 400px;
        } 
      .back_button {
      margin-top: 15px;
       border: none;
       align-items: center;
       display: flex;
       border-radius: 25px;
       align-self: center;
       width: 200px;
       height: 40px;
       font-weight: bolder;
       font-size: 15px;
       text-align: center;
       color: #e5e3ff;
       background-color: #6a679e;
       cursor: pointer;
      }

      .back_button > svg {
       margin-right: 5px;
       margin-left: 5px;
       font-size: 20px;
       transition: all 0.4s ease-in;
      }
      .back_button:hover{
        background: none;
        color: white;
        border-bottom: 2px solid white;
      }
      .hidden{
        display: none;
      }
      
        button {
          border: 2px solid #e5e3ff;
          border-radius: 25px;
          width: 200px;
          height: 40px;
          font-weight: bolder;
          font-size: 15px;
          text-align: center;
          color: #e5e3ff;
          background-color: #6a679e;
          cursor: pointer;
        }
        button:hover {
          background-color: #e5e3ff;
          color: #6a679e;
          transition: 0.5s ease;
        }
        .mobile-back-btn{
          display: none;
        }
      @media only screen and (max-width: 1100px){
        .mobile-back-btn{
          display: block;
          position: absolute;
          top: 15px;
          left: 15px;
          color: #6a679e;
          font-size: 20px;
          font-weight: bold;
          text-decoration: none;
        }
        .outer-div{
          width: 90%;
          display: flex;
          flex-direction: column;
          justify-content: center;
          align-items: center;
          height: 650px;
        }
        .inner-div{
          display: none;
        }
        .loginPane, .signUpPane{
          margin: inherit;
          width: 100%;
          height: 75%;
          padding: 0;
        margin-top: -0px;
          /* margin-top: -500px; */
        }
        .signUpPane{
          margin-top: -60px;
        }
        #moveButton{
          margin-left: 0;
        }
        .things{
          width: 100%;
        }
      }
    </style>
  </head>
  <body>          
    <div class="outer-div">
      <a href="../index.php" class="mobile-back-btn"><i class="fa-regular fa-arrow-left"></i>  Go back</a>
      <div class="inner-div">
        <a href="../index.php" id="back" >
          <button class="back_button">
            <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 1024 1024"><path d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z"></path></svg>
            <span>Back to Home page</span>
          </button>
        </a>
          <div class="logo">
            <h1>Logo</h1>
          </div>
        <p>Here to make Your Career progression way simpler...</p>
      </div>
      <div class="loginPane fade-in">
      <form action="login_process.php" method="post">
          <h1>Sign back in</h1>
          <div class="social-icons">
            <div class="social">
              <a href="#">
                <svg
                  fill="#000000"
                  width="80px"
                  height="24px"
                  viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M12 2.03998C6.5 2.03998 2 6.52998 2 12.06C2 17.06 5.66 21.21 10.44 21.96V14.96H7.9V12.06H10.44V9.84998C10.44 7.33998 11.93 5.95998 14.22 5.95998C15.31 5.95998 16.45 6.14998 16.45 6.14998V8.61998H15.19C13.95 8.61998 13.56 9.38998 13.56 10.18V12.06H16.34L15.89 14.96H13.56V21.96C15.9164 21.5878 18.0622 20.3855 19.6099 18.57C21.1576 16.7546 22.0054 14.4456 22 12.06C22 6.52998 17.5 2.03998 12 2.03998Z"
                  />
                </svg>
              </a>
            </div>
            <div class="social">
              <!-- Google ICon -->
              <a href="#">
                <svg
                  fill="#000000"
                  width="70px"
                  height="70px"
                  viewBox="0 0 32 32"
                  version="1.1"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M16.601 14.648v4.105h9.813c-0.162 2.008-0.982 3.798-2.243 5.18l0.006-0.007c-1.825 1.86-4.364 3.012-7.172 3.012-0.142 0-0.283-0.003-0.424-0.009l0.020 0.001c-5.946-0.003-10.765-4.823-10.765-10.77 0-0.051 0-0.102 0.001-0.152l-0 0.008c-0.001-0.043-0.001-0.094-0.001-0.145 0-5.946 4.819-10.767 10.765-10.77h0c0.040-0.001 0.087-0.001 0.135-0.001 2.822 0 5.383 1.121 7.262 2.941l-0.003-0.003 2.888-2.888c-2.568-2.578-6.121-4.174-10.047-4.174-0.082 0-0.164 0.001-0.246 0.002l0.012-0c-0.002 0-0.005 0-0.008 0-8.337 0-15.11 6.699-15.228 15.009l-0 0.011c0.118 8.32 6.891 15.020 15.228 15.020 0.003 0 0.006 0 0.009 0h-0c0.169 0.007 0.367 0.012 0.566 0.012 3.892 0 7.407-1.616 9.91-4.213l0.004-0.004c2.208-2.408 3.561-5.63 3.561-9.169 0-0.15-0.002-0.3-0.007-0.449l0.001 0.022c0.001-0.054 0.001-0.119 0.001-0.183 0-0.844-0.079-1.669-0.231-2.469l0.013 0.082z"
                  ></path>
                </svg>
              </a>
            </div>
            <div class="social">
              <!-- Apple Icon -->
              <a href="#">
                <svg
                  width="80px"
                  height="80px"
                  viewBox="-1.5 0 20 20"
                  version="1.1"
                  xmlns="http://www.w3.org/2000/svg"
                  xmlns:xlink="http://www.w3.org/1999/xlink"
                >
                  <title>apple [#173]</title>
                  <desc>Created with Sketch.</desc>
                  <defs></defs>
                  <g
                    id="Page-1"
                    stroke="none"
                    stroke-width="1"
                    fill="none"
                    fill-rule="evenodd"
                  >
                    <g
                      id="Dribbble-Light-Preview"
                      transform="translate(-102.000000, -7439.000000)"
                      fill="#000000"
                    >
                      <g
                        id="icons"
                        transform="translate(56.000000, 160.000000)"
                      >
                        <path
                          d="M57.5708873,7282.19296 C58.2999598,7281.34797 58.7914012,7280.17098 58.6569121,7279 C57.6062792,7279.04 56.3352055,7279.67099 55.5818643,7280.51498 C54.905374,7281.26397 54.3148354,7282.46095 54.4735932,7283.60894 C55.6455696,7283.69593 56.8418148,7283.03894 57.5708873,7282.19296 M60.1989864,7289.62485 C60.2283111,7292.65181 62.9696641,7293.65879 63,7293.67179 C62.9777537,7293.74279 62.562152,7295.10677 61.5560117,7296.51675 C60.6853718,7297.73474 59.7823735,7298.94772 58.3596204,7298.97372 C56.9621472,7298.99872 56.5121648,7298.17973 54.9134635,7298.17973 C53.3157735,7298.17973 52.8162425,7298.94772 51.4935978,7298.99872 C50.1203933,7299.04772 49.0738052,7297.68074 48.197098,7296.46676 C46.4032359,7293.98379 45.0330649,7289.44985 46.8734421,7286.3899 C47.7875635,7284.87092 49.4206455,7283.90793 51.1942837,7283.88393 C52.5422083,7283.85893 53.8153044,7284.75292 54.6394294,7284.75292 C55.4635543,7284.75292 57.0106846,7283.67793 58.6366882,7283.83593 C59.3172232,7283.86293 61.2283842,7284.09893 62.4549652,7285.8199 C62.355868,7285.8789 60.1747177,7287.09489 60.1989864,7289.62485"
                          id="apple-[#173]"
                        ></path>
                      </g>
                    </g>
                  </g></svg></a>
            </div>
          </div>
          <?php
            if (isset($_GET['error'])) {
             echo "<p class='error-message'>" . htmlspecialchars($_GET['error']) . "</p>";
            }
          ?>
          <p>Or use your Username?</p>
          <div class="things">
            <svg
              width="80px"
              height="80px"
              viewBox="0 0 16 16"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M8 7C9.65685 7 11 5.65685 11 4C11 2.34315 9.65685 1 8 1C6.34315 1 5 2.34315 5 4C5 5.65685 6.34315 7 8 7Z"
                fill="#000000"
              />
              <path
                d="M14 12C14 10.3431 12.6569 9 11 9H5C3.34315 9 2 10.3431 2 12V15H14V12Z"
                fill="#000000"
              />
            </svg>
            <input type="text" placeholder="Username" name="name" />
          </div>
          
          <br />
          <div class="things">
          <svg
            width="80px"
            height="80px"
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M12 14.5V16.5M7 10.0288C7.47142 10 8.05259 10 8.8 10H15.2C15.9474 10 16.5286 10 17 10.0288M7 10.0288C6.41168 10.0647 5.99429 10.1455 5.63803 10.327C5.07354 10.6146 4.6146 11.0735 4.32698 11.638C4 12.2798 4 13.1198 4 14.8V16.2C4 17.8802 4 18.7202 4.32698 19.362C4.6146 19.9265 5.07354 20.3854 5.63803 20.673C6.27976 21 7.11984 21 8.8 21H15.2C16.8802 21 17.7202 21 18.362 20.673C18.9265 20.3854 19.3854 19.9265 19.673 19.362C20 18.7202 20 17.8802 20 16.2V14.8C20 13.1198 20 12.2798 19.673 11.638C19.3854 11.0735 18.9265 10.6146 18.362 10.327C18.0057 10.1455 17.5883 10.0647 17 10.0288M7 10.0288V8C7 5.23858 9.23858 3 12 3C14.7614 3 17 5.23858 17 8V10.0288"
              stroke="#000000"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
          <input type="password" name="password" id="pass" placeholder="Password"/>
          </div>

          <h3><a href="OTPRequest.php">Forgot Password?</a></h3>
          <button type="submit" class="submit-btn">Submit</button>
          </form>
        </div>
        
      
        <div class="signUpPane hidden">
          <form action="signup_process.php" method="post">
            <h1>Sign Up</h1>
            <div class="social-icons">
              <div class="social">
              <!-- Facebook Icon -->
                <a href="#"><svg fill="#000000" width="80px" height="px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path d="M12 2.03998C6.5 2.03998 2 6.52998 2 12.06C2 17.06 5.66 21.21 10.44 21.96V14.96H7.9V12.06H10.44V9.84998C10.44 7.33998 11.93 5.95998 14.22 5.95998C15.31 5.95998 16.45 6.14998 16.45 6.14998V8.61998H15.19C13.95 8.61998 13.56 9.38998 13.56 10.18V12.06H16.34L15.89 14.96H13.56V21.96C15.9164 21.5878 18.0622 20.3855 19.6099 18.57C21.1576 16.7546 22.0054 14.4456 22 12.06C22 6.52998 17.5 2.03998 12 2.03998Z"/></svg></a>
            </div>
            <div class="social">
              <!-- Google ICon -->
              <a href="#">
                <svg
                  fill="#000000"
                  width="70px"
                  height="70px"
                  viewBox="0 0 32 32"
                  version="1.1"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M16.601 14.648v4.105h9.813c-0.162 2.008-0.982 3.798-2.243 5.18l0.006-0.007c-1.825 1.86-4.364 3.012-7.172 3.012-0.142 0-0.283-0.003-0.424-0.009l0.020 0.001c-5.946-0.003-10.765-4.823-10.765-10.77 0-0.051 0-0.102 0.001-0.152l-0 0.008c-0.001-0.043-0.001-0.094-0.001-0.145 0-5.946 4.819-10.767 10.765-10.77h0c0.040-0.001 0.087-0.001 0.135-0.001 2.822 0 5.383 1.121 7.262 2.941l-0.003-0.003 2.888-2.888c-2.568-2.578-6.121-4.174-10.047-4.174-0.082 0-0.164 0.001-0.246 0.002l0.012-0c-0.002 0-0.005 0-0.008 0-8.337 0-15.11 6.699-15.228 15.009l-0 0.011c0.118 8.32 6.891 15.020 15.228 15.020 0.003 0 0.006 0 0.009 0h-0c0.169 0.007 0.367 0.012 0.566 0.012 3.892 0 7.407-1.616 9.91-4.213l0.004-0.004c2.208-2.408 3.561-5.63 3.561-9.169 0-0.15-0.002-0.3-0.007-0.449l0.001 0.022c0.001-0.054 0.001-0.119 0.001-0.183 0-0.844-0.079-1.669-0.231-2.469l0.013 0.082z"
                  ></path></svg></a>
            </div>
            <div class="social">
              <!-- Apple Icon -->
              <a href="#">
                <svg
                  width="80px"
                  height="80px"
                  viewBox="-1.5 0 20 20"
                  version="1.1"
                  xmlns="http://www.w3.org/2000/svg"
                  xmlns:xlink="http://www.w3.org/1999/xlink"
                >
                  <title>apple [#173]</title>
                  <desc>Created with Sketch.</desc>
                  <defs></defs>
                  <g
                    id="Page-1"
                    stroke="none"
                    stroke-width="1"
                    fill="none"
                    fill-rule="evenodd"
                  >
                    <g
                      id="Dribbble-Light-Preview"
                      transform="translate(-102.000000, -7439.000000)"
                      fill="#000000"
                    >
                      <g
                        id="icons"
                        transform="translate(56.000000, 160.000000)"
                      >
                        <path
                          d="M57.5708873,7282.19296 C58.2999598,7281.34797 58.7914012,7280.17098 58.6569121,7279 C57.6062792,7279.04 56.3352055,7279.67099 55.5818643,7280.51498 C54.905374,7281.26397 54.3148354,7282.46095 54.4735932,7283.60894 C55.6455696,7283.69593 56.8418148,7283.03894 57.5708873,7282.19296 M60.1989864,7289.62485 C60.2283111,7292.65181 62.9696641,7293.65879 63,7293.67179 C62.9777537,7293.74279 62.562152,7295.10677 61.5560117,7296.51675 C60.6853718,7297.73474 59.7823735,7298.94772 58.3596204,7298.97372 C56.9621472,7298.99872 56.5121648,7298.17973 54.9134635,7298.17973 C53.3157735,7298.17973 52.8162425,7298.94772 51.4935978,7298.99872 C50.1203933,7299.04772 49.0738052,7297.68074 48.197098,7296.46676 C46.4032359,7293.98379 45.0330649,7289.44985 46.8734421,7286.3899 C47.7875635,7284.87092 49.4206455,7283.90793 51.1942837,7283.88393 C52.5422083,7283.85893 53.8153044,7284.75292 54.6394294,7284.75292 C55.4635543,7284.75292 57.0106846,7283.67793 58.6366882,7283.83593 C59.3172232,7283.86293 61.2283842,7284.09893 62.4549652,7285.8199 C62.355868,7285.8789 60.1747177,7287.09489 60.1989864,7289.62485"
                          id="apple-[#173]"
                        ></path>
                      </g>
                    </g>
                  </g></svg></a>
            </div>
          </div>
          <p>Or use a Username?</p>

          <div class="things">
          <svg
            width="80px"
            height="80px"
            viewBox="0 0 16 16"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M8 7C9.65685 7 11 5.65685 11 4C11 2.34315 9.65685 1 8 1C6.34315 1 5 2.34315 5 4C5 5.65685 6.34315 7 8 7Z"
              fill="#000000"
            />
            <path
              d="M14 12C14 10.3431 12.6569 9 11 9H5C3.34315 9 2 10.3431 2 12V15H14V12Z"
              fill="#000000"
            />
          </svg>
          <input type="text" placeholder="Username" name="username" />
          </div>
          <br />
          <div class="things">
          <svg
            width="80px"
            height="80px"
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M21 8L17.4392 9.97822C15.454 11.0811 14.4614 11.6326 13.4102 11.8488C12.4798 12.0401 11.5202 12.0401 10.5898 11.8488C9.53864 11.6326 8.54603 11.0811 6.5608 9.97822L3 8M6.2 19H17.8C18.9201 19 19.4802 19 19.908 18.782C20.2843 18.5903 20.5903 18.2843 20.782 17.908C21 17.4802 21 16.9201 21 15.8V8.2C21 7.0799 21 6.51984 20.782 6.09202C20.5903 5.71569 20.2843 5.40973 19.908 5.21799C19.4802 5 18.9201 5 17.8 5H6.2C5.0799 5 4.51984 5 4.09202 5.21799C3.71569 5.40973 3.40973 5.71569 3.21799 6.09202C3 6.51984 3 7.07989 3 8.2V15.8C3 16.9201 3 17.4802 3.21799 17.908C3.40973 18.2843 3.71569 18.5903 4.09202 18.782C4.51984 19 5.07989 19 6.2 19Z"
              stroke="#000000"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
          <input type="email" placeholder="Email" name="email" />
          </div>
          <br />
          <div class="things">
          <svg
            width="80px"
            height="80px"
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M12 14.5V16.5M7 10.0288C7.47142 10 8.05259 10 8.8 10H15.2C15.9474 10 16.5286 10 17 10.0288M7 10.0288C6.41168 10.0647 5.99429 10.1455 5.63803 10.327C5.07354 10.6146 4.6146 11.0735 4.32698 11.638C4 12.2798 4 13.1198 4 14.8V16.2C4 17.8802 4 18.7202 4.32698 19.362C4.6146 19.9265 5.07354 20.3854 5.63803 20.673C6.27976 21 7.11984 21 8.8 21H15.2C16.8802 21 17.7202 21 18.362 20.673C18.9265 20.3854 19.3854 19.9265 19.673 19.362C20 18.7202 20 17.8802 20 16.2V14.8C20 13.1198 20 12.2798 19.673 11.638C19.3854 11.0735 18.9265 10.6146 18.362 10.327C18.0057 10.1455 17.5883 10.0647 17 10.0288M7 10.0288V8C7 5.23858 9.23858 3 12 3C14.7614 3 17 5.23858 17 8V10.0288"
              stroke="#000000"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
          <input
            type="password"
            name="password"
            id="pass"
            placeholder="Password"
          />
          </div>
          <br />
          <div class="things"><svg
            width="80px"
            height="80px"
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M12 14.5V16.5M7 10.0288C7.47142 10 8.05259 10 8.8 10H15.2C15.9474 10 16.5286 10 17 10.0288M7 10.0288C6.41168 10.0647 5.99429 10.1455 5.63803 10.327C5.07354 10.6146 4.6146 11.0735 4.32698 11.638C4 12.2798 4 13.1198 4 14.8V16.2C4 17.8802 4 18.7202 4.32698 19.362C4.6146 19.9265 5.07354 20.3854 5.63803 20.673C6.27976 21 7.11984 21 8.8 21H15.2C16.8802 21 17.7202 21 18.362 20.673C18.9265 20.3854 19.3854 19.9265 19.673 19.362C20 18.7202 20 17.8802 20 16.2V14.8C20 13.1198 20 12.2798 19.673 11.638C19.3854 11.0735 18.9265 10.6146 18.362 10.327C18.0057 10.1455 17.5883 10.0647 17 10.0288M7 10.0288V8C7 5.23858 9.23858 3 12 3C14.7614 3 17 5.23858 17 8V10.0288"
              stroke="#000000"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
          <input
            type="password"
            name="confirm_password"
            id="pass2"
            placeholder="Re-enter Password"
          /></div>
          <br />
          <button type="submit" class="submit-btn">Submit</button>
          </form>
        </div>
      
      <button type="button" id="moveButton">Create Account</button>
    </div>
    <script src="../js/script.js"></script>
  </body>
</html>
