<template>
  <div class="col-sm-2 w-100 vh-full d-flex flex-column">
    <div class="logo w-full mt-4 d-flex flex-row align-items-center">
      <img src="https://img.icons8.com/color/48/control-panel--v1.png" alt="logo" width="60px" height="60px">
      <label class="ms-3 fs-2 text-white">Marketing</label>
    </div>
    <hr class="text-white"/>
    <div class="logo w-full d-flex flex-row align-items-center">
      <img src="https://img.icons8.com/color/48/circled-user-male-skin-type-3--v1.png" alt="logo" width="60px" height="60px">
      <label class="ms-3 fs-4 text-white">{{ name }}</label>
      <img @click="reloadPage" class="ms-4 c_pointer" width="30" height="30" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAABNUlEQVR4nO3aO05DMRBGYUNBiwQtG0FZGG0aXjvJCmgQC6AIUNDR5rKNE01kikjJlSfRDf+MfHpL88nJfckFuACegV90GoBHm620Bjyh24MHYnrrtogEzOpMg2fRpiIW3rk6ZOLoOyIWfUfEAu5SXLUsYF4yQFx1yIQBC+AFuAz90wKWdaz3Zowo5Ab4qaMZ6iok5CCMKmQH5mMUowxxYdQhezDXJSKkCRMFsgPzuYWJBBnFRIPsxRwDAc6AL/6/5bGQ8/rHiw1J89OSugwTCMLYvSQKhAw3RFqet9QhtD7OK0PwvJOoQsjwYkWWV13gO8vHhzfgNfznoIPqkBNEho/YwNw1lzBk03QLThTeuTpk4ug7kmBHhrpmVvQO1aw8i+xclGr3HogdPDPM384otDKE5+DZGhon/IxufD43AAAAAElFTkSuQmCC">
    </div>
    <hr class="text-white"/>


    <div>
      <div class="w-100 ">
        <button class="btn w-full w-100 btn-secondary d-flex align-items-center" type="button">
          <img height="30" width="30" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAAFCklEQVR4nO2aS2xVVRSGzxVaMZFWWqQoYIwTBYkDCM6IRGM6sChgWiXGoYbaBh0oUUwKOiOYRoc6MEYTiUo0qYgmxogBEWOoRikFHzzUmZX4DtbSz6zef8fl7Xncx7mXaviTM+je+6y91tnr8a99G0UX8D8FcBlwB7ATeAsYBc4Af+o5o7E9WnM70BrNBADNwEbgbWCCyjEho+82WdF5MOBiYDPwnVPqLLAP2AasB5YB84AmGTxPY+u15gOdVMC3QH/DDAJuBb50CnwGbDJFE9ZfYk/CXBvQKxkB5n431/sUngEmteHnQBdQyHjPjD6esaYArAWOSLbtMZj76QCXA4ecCz1iLlPmu1Moc20TsEV7GA4C7TUbIOFXAcck+GtghZszX99cqyHAg8CA+3slcMK52pI8TiIYcRhY4OZmAb/JDVanyLCMtjdlfrVkmKyL3HgHMKy9j1Z9MoqJQ86Ilpg1diKG4ao2Kcr4VDK2xcy1OmM+rCpmFNjBnRYkrJkDjADfZAV9SpCfkIw5CWs6nJsNVpNiJxV0KzLWzrbTq9CG0pOfnbFmlWrOZNmpWYKP6ws8HM0QAI+64M92MVXsUCemvhQwvxHKpkHswFzQ0FfO4kA7ujT2kP5+FVgcNQAUU/6AYu89N26k1HA69VREAAPtKLh4+VXjPwFX1kl5c+ke4B3gnKMsB0uSg3mKoSfKyPmGTSXji4GXgS9yq7T/yL4BeBoYYzreLaX65laa25PWT0woU8USwByVbxVZ/IRkPB9Hg+xDAuN6ptU2W7BOAt6vowFGPZ5VFce563PAkP62FLs9Q84BH8elk9a1xVbYGpVfBDyuwhpwTm6zUVT+dY2fBe4pQ+YTWr8jbtJaUMO6nAxoAV4o6RxPS4mrXdX+WHM/AjeVKXuD3hmKmwzN0tIcjDAFv3Jf+RWgs4QULnXUw9LsdRXIv17vHYubDFmj3fUG1+ipiIIAL0rWbmPQMfNrdBlh+CiJy7m0HPRoCgVa7/4QlcL1z1OFxtF3VCRT+VDCR+mImbvX7bU7qQ12H/N7p8cxZ9zUaUdlGLJLR27Pm5WwW+AXyVpYUswGXKv8lHe1BDkFxW7QY1c5hvzLtWoB8IZkvQZcYWwAeEljFvwP1Ch/fpprBca7rJZNJOtaFwMeRnVuy0H+cskbbUT6XSKi+bP8fEdIuznI3pCWfkNBTK2qMwHAk2kFMVDkfdEMB8X+nVg3FWn8S9mrLWZ+VixJq5+yLbZnQqAH0jg36eW9srS3ZLxTyeB3n1LrBYqZ7g/t2Vky158YH27RXTGN1f0u69j4pQ0wZK67JjLcF9NYdWe1unYrblirsW7gpF1ElHtNmpMxTdrzZFDatRqnMnVxR3ekkYpngeJHPhrn+mkv2JWLYUs0QwBslU4jZX9g4BZ3Qbey7lpm63Oju6BbU+nL9vsE6hmmsdhGAViomDDsrEZAs36fQBfJDf/hkuIlRche+6uOWd1YhACzq6BFuWubfhLDLi7a8iB/wRhLhaty0zY9Jk45I/K54dTJBH5jQfdYPVIzRXfe6pq8/TWfRMImg67DGxHRLOQgu6BiNyrZk2Lj9atj9vuE2xBRhr5qOksRwH7FX8BIxSm2xtPp0z1VwLhcYbsan+VyyWY97Rq7U3dbB8S2Aywmes8Lm5CCPeouvVLlYlwXG90zhg5RZKxdammH5H5j7p9qxpT9hrSmK7GfuIDov4+/AVX8tzNEmwMGAAAAAElFTkSuQmCC">
          <router-link to="/admin/dashboard" class="fs-5 text-decoration-none text-white ms-3">Dashboard</router-link>
        </button>
      </div>

      <div class="dropdown w-100 mt-2">
        <button class="align-items-center d-flex btn w-100 btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img width="30" height="30" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAACKklEQVR4nO2av04UURSHrwF5AYL8sbCkp4SGGDuIhWBlrKSWhIC0ECyIxsKSJ5A3QIoFCmPlO1hZGAvCCkQh8JEDv0luNgPe3Z25M+D9ksnevXPm3PPbc3Yyd886l0gkOgKYBhrAIdXzW7FMtSviLfVlrZ1MGH+ARWDYVQwwDCwpJoIyA+zIeNHVDOCNYmuEGFs9GkOuZgBDiq0ZYnyJqymExpeERIKUkZpByoigIlzRGbmLQkZdyQCjMYQ0gdkC48571tuPIcQ4B9aBngIF3AOWgbNYpbUAnGq8DfQXIKJfvpBvW6NcIRpPAj819R0Y60LEmHwY5nMyNI6uhej9Q+Crpm2f8KoDES+AI/n4BjxqN46uhWiuV9+VjA2gL2CNf15HTCHeuZfAsUy+3LSrBAa8zZtlcq6oOIoQMqPbcsYPYDzHblznMg6AZ9f4bDuOjh2oRN7rdmxsArsa/wVWgQc6VjWHbD5pbNe+M1+uCiHAILCn6RNg3hP3wRPnc65zl0EDr3VtJm4wqhBgwisRe53IsX8CfAZ+6dgCHufY5fqibCEtn+Ke/yl2irKbleSJ1ihdSFYiH4H73Yrw/PcAK60lWaYQuzs9L0pAzjpPYz003pnH+Ki4JES4mkJofElIJEgZqRn8jxlpyrbyllsr2l4bByHG1j01llzN4OrnouDW25S3DbWe3UiUKG+OaUQiso1ZWJvaWsDc9vZ0S2YaXnP09v1hIJFIuIwLPaAe/ccUsQsAAAAASUVORK5CYII=">
          <label class="fs-5 text-decoration-none text-white ms-3 me-1">Products</label>
        </button>
        <ul class="w-100 dropdown-menu">
          <li><router-link to="/admin/products" class="fs-5 text-decoration-none text-black ms-3">Show products</router-link></li>
          <hr/>
          <li><router-link to="/admin/add-product" class="fs-5 text-decoration-none text-black ms-3">Add product</router-link></li>
        </ul>
      </div>

      <div class="dropdown w-100 mt-2">
        <button class="align-items-center d-flex btn w-100 btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img width="30" height="30" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAAClklEQVR4nO2YTW4TQRCFrSwwcAVWEOSb2DL7WHgW4QSECxBYIC4QyXCDZE8SrsDPKmxAEZK5AbaCI2CB9aFCZWlod/fU9IwXUfpJvbBd/fxed3VN9XQ6GRkZXgBd4AnwAbgkjEuN2ZM5Bt4toAcMgBFQBMZIYyR2q4rX/ZM7wCfq40zmRnhvAQ8ioovAGMrcOiufIr5sohtY+RTxRclE9U5o2jTFYw9vr4H4QkfPYuBjCwbee3gHLRjoWwwsWjCw8PDGDmxhHCOLgVbg4S3aGJ1swIi8A+QUuroptKA5LjZURneuxYNs76q3El1tyFIhc28Emrnhxpu5Ujt9tqF2erjRdnoFWUVJBcnnioMtv73T2LWVj1xo+oYLTT/pQpORkdFZVYxnwBEwjhy2scbsAzer1g64DbwEzoHfWgiWwMRziFdvLip53T/ZBr6WKs1JxMDbUpyIuhfhvQ98c6rY0iN+NSb6+1Q01Vn5snjBRcSAW2LPfTVbVz5F/ApT004Az1nH94iBuSd+38MraZMqHv1suhNLPrt4EzFw7Ik/9PDKzljEHwB/HD6Jf21t5saa8z+AmQrcjRh4pDEzTTWZO/bw/iqJeZUgvrDuQEjorgqdW4x5eJuKL3y8dQz4UuW4hoHG4mlowHdY5zUMpOR80aYBSRtzdTLyHtQRL4vQdgoFq5OBt674f/FtHOJZ4iFuLB7P245QGT3VJ+zcWEZPNHahcx96eEdNxQM/Ux9kwWqj4l0ceXgHKTnP/0/kLxYD0oGaq02gOj0N7MCyYTvxwtrMlR/7Kc3cWtMl32lDlip+am6rpSV2TMTa6VNH/N2KNn2aKH7bJN5ZMbmkHLZ8oRHencBbiUlJvPROnyVtal9oMjKuEf4CNpCSz5jgHqsAAAAASUVORK5CYII=">
          <label class="fs-5 text-decoration-none text-white ms-3 me-1 ">Categories</label>
        </button>
        <ul class="w-100 dropdown-menu">
          <li><router-link to="/admin/categories" class="fs-5 text-decoration-none text-black ms-3">Show categories</router-link></li>
          <hr/>
          <li><router-link to="/admin/add-category" class="fs-5 text-decoration-none text-black ms-3">Add category</router-link></li>
        </ul>
      </div>

      <div class="dropdown w-100 mt-2">
        <button class="align-items-center d-flex btn w-100 btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img width="30px" height="30px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAACo0lEQVR4nO2ZO2sVQRiGJwFB9CiYQlFBRQkWaay8EtQcFSMIgj/BXyHYahMVElSSiGgjorWtBq3UTvFSCMZo5S3GC+hRzCOD38rHsLtnzuzu2Y3uA4EU3+V9d4Y5+80aU1NT828DHAIeAC3y5RGwVvXZB7x1YlrSeziL+HmK45jqdTUlbj7IhLgviocxK/AmJf5+iAG9bVaYLgP0qf7fQwr8pRCFRWoAeqtmAOj1TeoBJlViq3ClftvYaurxSRpxnI+akgBGHS0jPkmzKuGy99IVAH+28hWlZ9Yn6bFKONwVpSkAR5SeJz4Jl1TCNVMywA2l56JPwl6V8AsY9MhZAvR3IGrA5njE7RYNEXt8G9xSSe+ArSmxW4Bpib0OLG9T+5TEvrC5KXHbgPdKx20v8ZLcD3zQRylwToouBRrAdmAs5kXPvpSdEGM2djGwSNWecuqOSa2GxNv/zwM/nLobvQ1Io13OiZSFz9FWBHaG1DUhAJuAO21q2z06IcLupsSddVZ4qnADqmFTfgmfAV/lz77TnwE2O7GDwDjwVOK+ydE8kFB3QmK/AHNSd1x2QLgB4Chw057DpiTIaMA+DcvHQtR1wUA++y8D1AaEegUCQZH2s26PucpjEgzYs5eFbODkgl6BNDIl5wS1AaFeAQHYIC9vr4GfwCuZB1aZGDI9xEzJ8fUOyFwQxydgR2UNyJNPEh9hh5w1eRrQo2JfRgN226Bm4SEZH5tqnraczvNyN+v1+vNo2JE9HzHk9Gl61Aq6Xh/O4QPH8ZjVbDh9lrWpYTUc7NiAMnEv8BOTXgF72kQ0nR77E/Jb0jtMfJ7IjBsxLV9kGiL+ZUeXt2UArJejst0ptNpUFXnqSSbm7IWWqTrAOuACMCM3bzPyDWBl2dpq/kt+Awe+qMVVnJszAAAAAElFTkSuQmCC">
          <label class="fs-5 text-decoration-none text-white ms-3 me-1">Vendors</label>
        </button>
        <ul class="w-100 dropdown-menu">
          <li><router-link to="/admin/vendors" class="fs-5 text-decoration-none text-black ms-3">Show vendors</router-link></li>
          <hr/>
          <li><router-link to="/admin/add-vendor" class="fs-5 text-decoration-none text-black ms-3">Add vendor</router-link></li>
        </ul>
      </div>

      <div class="dropdown w-100 mt-2">
        <button class="align-items-center d-flex btn w-100 btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img width="30px" height="30px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAAB9ElEQVR4nO2Zy0rDQBSGgwtFfIBavIBv4FJwIS7EC/gkrSux9Q2M7+DKjS8guNCtxY3VB7DiwstOtC2oC/0kdFrG2EvSOTNJIR8USiFnvj85SWamnpeRkWEVYALYAa6AJvF4Ak6ApaTkZ4EbzPkG9lzLzwM15PgB1pKS/wRKQD5mnRngVKtzYc+6v/ymQb05rVZD1rb7YHfagF/AtkDdDjKmDuUDrAfo0jYfUdoGGAcOgWf1yPSD35wGGFZeHevzH99ZANO2oXXmw7w4CSDR87TaJsyj9QCqbe6HaZsILXRgNYCUvHYT++pK2L+JJeVjjtvBtNBZSH5DzLIPkgHOXctLB5gGdoFFo0Lxxsxr/nVv1AD2tQCVOAfmXJ/tMMCyms22KXgxXlLt6cE7MOklAHCkyVe7PWJ7rWH1ZeArMOXEOASwqsa/DpanXhSAotRiJBGAihag5HjsFeDY6KQBb1qAnKhh/3G3tBu2DoyNTAD+ygfcSrVQWdQ0mnwtmHOZFCy4uomRltceo1XbIazIh7YExfZ2nMo72ONZV7PZNg/AgmldJyGcykuHSERecPskOXnTEKmQHzZEquTjhkil/ID/AMpq/ZpX3+0+5y1ciV6k58z3eGPr044w1cgrqaRQ24NFNYttqM+lmhQOXsNmZGR4JvwCBe6ojNTlTcYAAAAASUVORK5CYII=">
          <label class="fs-5 text-decoration-none text-white ms-3 me-1">Brands</label>
        </button>
        <ul class="w-100 dropdown-menu">
          <li><router-link to="/admin/brands" class="fs-5 text-decoration-none text-black ms-3">Show brands</router-link></li>
          <hr/>
          <li><router-link to="/admin/add-brand" class="fs-5 text-decoration-none text-black ms-3">Add brand</router-link></li>
        </ul>
      </div>

      <div class="dropdown w-100 mt-2">
        <button class="align-items-center d-flex btn w-100 btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img width="30" height="30" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAACB0lEQVR4nO2Xu0okQRSGC28gGq66oG+wGymma6qMsqBj4L6AsmZiZuSqYOYjiKH4DF4QU3Vz8TaGgndFFPzksKWMNdU93dPVM71YHzQMnMt/TvXpqhqlPB6Px+NxCNAOzAP7wJ1+9oA5saksA4wCNwQjtrzKcPEvlOclc03wb2zCVt7kGmhTWUHPfFz+qKwA/K2ggb20i/oJbBXtJJvAUIBvnPF54yapbljxiyHCC44auE6qq0JWoByDRozs+YlGiAp0gxqQ11eODSNGDqm4zCbVDWrgNu78VrCNXgFfkuo6a0DH5WMcZMOudEvQX3051ksj35uQQyps5Ydd635AtqwIiXIh8W1ySAG7elVv9e9Zc2xc6prJFkKSzKmUwKWubFny1Ret4nrkFUgANdL11BSgGegDZoBVfTKfA4/6Odf/yla1zw+JUTUuugEYAdaAB+Jzr2MlR4PrwnLAEjBmsdcDE8AR7jgCxoE6i94vXUsutFE9BpNFhR0CjYZPV8Q7S6VsAp2GZhNwXNTo75LxA3qBAyPZlOHzFTglfU6ADkN72vCRWnvejD0B95BvRpIVqseyof3d4iOXx24x7gQkaTGSXFI9Lgzt1gC/bTE+2yyWb6SqqGj6T4GF/ScN4BtIC/WZ3sBZxARWv5QoRGygIIYBW3GWBFa/FCgA/REasPp5PB6P53PxCgdOAt2KUDGbAAAAAElFTkSuQmCC">
          <label class="fs-5 text-decoration-none text-white ms-3 me-1">Users</label>
        </button>
        <ul class="w-100 dropdown-menu">
          <li><router-link to="/admin/users" class="fs-5 text-decoration-none text-black ms-3">Show users</router-link></li>
          <hr/>
          <li><router-link to="/admin/add-user" class="fs-5 text-decoration-none text-black ms-3">Add users</router-link></li>
        </ul>
      </div>

      <div class="dropdown w-100 mt-2">
        <button class="align-items-center d-flex btn w-100 btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img width="30" height="30" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAAD0UlEQVR4nO2aW4hNURjH94zruAwjzAwlt8TIuKckSSISSRPNg5K7B5eh5EFqXGZexLwQhcwLiZJcEoo0JSmDmoQxZnK/lxiG/LTyHZbT3mdf1jpntvKvXdPe6/vv///svdb3rW+P4/zHf/wbAMYCW4ErwAPgkxyNwHFgLpDlxBVAEXCBYDgFdHHiBmCq/OoKb4EqYBYwEOgE5ACDgTXAaxn3GagG8p04ACjWTBwG8nzGTwBqge8S8xAoyJxiDwDXRNDBMO8+MAC4IbGnndYEME6EvI7yzqsnAXwQjvHpURlMSLmI2GPAsUs4dttVF07EWREx13ChULhuV104EXUiYrgBRz/heGFXXTgRT0TEIAOODsAPOXLsKgwuokmMFBnyJJbv7vbUhRNwVwSMMeBor2X8tnYVBhdxUgTMN+BQS7DCJ7vqwonYJiLKLaxaN+2qCyei1DQzA1uEY59ddeFErBARzww4aoTjkF114UTcERGLDDgmSgH5Bci2qzC4iJdipK8hz9vWXn6viIAFBhx9hON9q+0cgTIR8QjYECF+jjZHjqVHZTAhnYFbIqQ2QvxRiX0DDEmPyuBiegDf5OgaIi4beC5GRjlxAHBVBC0LETMr6pPMRGKsBzoGGN9OeyVXOnEB0Aa4LcJOKKE+4/fK2Ht+YzMOYITME4VuPmPVPv2dW9XML55kjE6reA+BQYw0JExIHvmdP4ASFyOLtetZKiYuRoZpPTHVgbmYqA74U0TqqJJrvYFzElOcCSOX/fbxmokEVJlSoe06dbwCKlVxqp1Ljxn1iwIt2o1apNWT6zFWNxEVr8LkriAmsrSuoY6vqrr1GH/egpH9tgwMBfrL3wulE6JjeYrYfK16joJGt6cdNmfMAy6J8LoEIbBDu9HeAFxHDIxURDWQC2wCHruQnpHaKVu+fajGdnsPnhnAeuAA8NGFqxlYJ02JQhmrzrnNj33AWmB6UBNLJTAVKmVs18Q3D2BV8hwJ8EuvS7Fd8ISfgRyt5eMH9ZqVarHTJNP/lZUD8BS46CiMbEQaZyofhIH6CjVFcoTaY1xw4fVDoW0j2zHH7AhGylxiNkYyIvWPntyi4L3bhAd6ApOllfTUJa5Z5kShHBukw5KMJll8Znh+ugM2Y45qz8dtZ/mtdALcwEbWXeJzj5GS+U2eeH8/I6orYopJAXeIJqhJ2cH3SEBhMdynPFF7ElM0tPp3evVaJJlRCVeVOPc9JvbOpKTc4PtqZQry/bBe/kell5xb7WJki1zLUxWvFIwDnTgheT8BzHQxUpIqJpZQ22AXIyP8An8CG1lh8sUUbqUAAAAASUVORK5CYII=">
          <label class="fs-5 text-decoration-none text-white ms-3 me-1">Admins</label>
        </button>
        <ul class="w-100 dropdown-menu">
          <li><router-link to="/admin/admins" class="fs-5 text-decoration-none text-black ms-3">Show admins</router-link></li>
          <hr/>
          <li><router-link to="/admin/add-admin" class="fs-5 text-decoration-none text-black ms-3">Add admin</router-link></li>
        </ul>
      </div>

      <div class="dropdown w-100 mt-2">
        <button class="align-items-center d-flex btn w-100 btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img width="30" height="30" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAAD0UlEQVR4nO2aW4hNURjH94zruAwjzAwlt8TIuKckSSISSRPNg5K7B5eh5EFqXGZexLwQhcwLiZJcEoo0JSmDmoQxZnK/lxiG/LTyHZbT3mdf1jpntvKvXdPe6/vv///svdb3rW+P4/zHf/wbAMYCW4ErwAPgkxyNwHFgLpDlxBVAEXCBYDgFdHHiBmCq/OoKb4EqYBYwEOgE5ACDgTXAaxn3GagG8p04ACjWTBwG8nzGTwBqge8S8xAoyJxiDwDXRNDBMO8+MAC4IbGnndYEME6EvI7yzqsnAXwQjvHpURlMSLmI2GPAsUs4dttVF07EWREx13ChULhuV104EXUiYrgBRz/heGFXXTgRT0TEIAOODsAPOXLsKgwuokmMFBnyJJbv7vbUhRNwVwSMMeBor2X8tnYVBhdxUgTMN+BQS7DCJ7vqwonYJiLKLaxaN+2qCyei1DQzA1uEY59ddeFErBARzww4aoTjkF114UTcERGLDDgmSgH5Bci2qzC4iJdipK8hz9vWXn6viIAFBhx9hON9q+0cgTIR8QjYECF+jjZHjqVHZTAhnYFbIqQ2QvxRiX0DDEmPyuBiegDf5OgaIi4beC5GRjlxAHBVBC0LETMr6pPMRGKsBzoGGN9OeyVXOnEB0Aa4LcJOKKE+4/fK2Ht+YzMOYITME4VuPmPVPv2dW9XML55kjE6reA+BQYw0JExIHvmdP4ASFyOLtetZKiYuRoZpPTHVgbmYqA74U0TqqJJrvYFzElOcCSOX/fbxmokEVJlSoe06dbwCKlVxqp1Ljxn1iwIt2o1apNWT6zFWNxEVr8LkriAmsrSuoY6vqrr1GH/egpH9tgwMBfrL3wulE6JjeYrYfK16joJGt6cdNmfMAy6J8LoEIbBDu9HeAFxHDIxURDWQC2wCHruQnpHaKVu+fajGdnsPnhnAeuAA8NGFqxlYJ02JQhmrzrnNj33AWmB6UBNLJTAVKmVs18Q3D2BV8hwJ8EuvS7Fd8ISfgRyt5eMH9ZqVarHTJNP/lZUD8BS46CiMbEQaZyofhIH6CjVFcoTaY1xw4fVDoW0j2zHH7AhGylxiNkYyIvWPntyi4L3bhAd6ApOllfTUJa5Z5kShHBukw5KMJll8Znh+ugM2Y45qz8dtZ/mtdALcwEbWXeJzj5GS+U2eeH8/I6orYopJAXeIJqhJ2cH3SEBhMdynPFF7ElM0tPp3evVaJJlRCVeVOPc9JvbOpKTc4PtqZQry/bBe/kell5xb7WJki1zLUxWvFIwDnTgheT8BzHQxUpIqJpZQ22AXIyP8An8CG1lh8sUUbqUAAAAASUVORK5CYII=">
          <label class="fs-5 text-decoration-none text-white ms-3 me-1">Vendors users</label>
        </button>
        <ul class="w-100 dropdown-menu">
          <li><router-link to="/admin/vendor-users" class="fs-5 text-decoration-none text-black ms-3">Show users</router-link></li>
          <hr/>
          <li><router-link to="/admin/add-vendor-user" class="fs-5 text-decoration-none text-black ms-3">Add user</router-link></li>
        </ul>
      </div>
      <div class="dropdown w-100 mt-2">
        <button class="align-items-center d-flex btn w-100 btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img width="30" height="30" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAACKklEQVR4nO2av04UURSHrwF5AYL8sbCkp4SGGDuIhWBlrKSWhIC0ECyIxsKSJ5A3QIoFCmPlO1hZGAvCCkQh8JEDv0luNgPe3Z25M+D9ksnevXPm3PPbc3Yyd886l0gkOgKYBhrAIdXzW7FMtSviLfVlrZ1MGH+ARWDYVQwwDCwpJoIyA+zIeNHVDOCNYmuEGFs9GkOuZgBDiq0ZYnyJqymExpeERIKUkZpByoigIlzRGbmLQkZdyQCjMYQ0gdkC48571tuPIcQ4B9aBngIF3AOWgbNYpbUAnGq8DfQXIKJfvpBvW6NcIRpPAj819R0Y60LEmHwY5nMyNI6uhej9Q+Crpm2f8KoDES+AI/n4BjxqN46uhWiuV9+VjA2gL2CNf15HTCHeuZfAsUy+3LSrBAa8zZtlcq6oOIoQMqPbcsYPYDzHblznMg6AZ9f4bDuOjh2oRN7rdmxsArsa/wVWgQc6VjWHbD5pbNe+M1+uCiHAILCn6RNg3hP3wRPnc65zl0EDr3VtJm4wqhBgwisRe53IsX8CfAZ+6dgCHufY5fqibCEtn+Ke/yl2irKbleSJ1ihdSFYiH4H73Yrw/PcAK60lWaYQuzs9L0pAzjpPYz003pnH+Ki4JES4mkJofElIJEgZqRn8jxlpyrbyllsr2l4bByHG1j01llzN4OrnouDW25S3DbWe3UiUKG+OaUQiso1ZWJvaWsDc9vZ0S2YaXnP09v1hIJFIuIwLPaAe/ccUsQsAAAAASUVORK5CYII=">
          <label class="fs-5 text-decoration-none text-white ms-3 me-1">Blog</label>
        </button>
        <ul class="w-100 dropdown-menu">
          <li><router-link to="/admin/posts" class="fs-5 text-decoration-none text-black ms-3">Show posts</router-link></li>
          <hr/>
          <li><router-link to="/admin/add-post" class="fs-5 text-decoration-none text-black ms-3">Add post</router-link></li>
        </ul>
      </div>
      <div class="w-100 mt-2">
        <button class="btn w-full w-100 btn-secondary d-flex align-items-center" type="button">
          <img width="30px" height="30px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAACXBIWXMAAAsTAAALEwEAmpwYAAAFWklEQVR4nO2bWWxVRRjHpxVRK8QNNGUp4r6BSiJVExfcSIhbIG4xMSYiYtD0wQeivIjE6Bv6pOiDptEXH1zjgiaoaLSugFpBsDEqgrjVJSBb+ZnP+790uNzbO2e5vef29J+cpL3nfLP8Z+ZbZr5xbhj1AdAM3Kyn2eUJwGXAKvrxNXCdG+oAzgFWqNNfWadFxmf67QPgAjfUAJwEPAfsAX4A5gEHeO+bRMa3IuIt4AzX6ADGAA8DO4DfgYXAwQN8f6DI+RnYBSwDWl2jAThUnf0L2CoSDo8gP0ryf3vyh7msAxgJ3A38ohF8AhiXcOnYbEBlWtkjXdZAYQ3fBPSosc8DpyQoz5bCncBmYDfwFPCCyu5RXU0uC6CgxT9V4z4ELkxY3lXAek8Znum9awfe0bsvgStT6UQcAKdLsxvWSovHHhXgfOA9lfcRcHEV0td4JE2LW29kAJOBZ4E+4EfgNt+kxShvCvCqOrMOmBNCpAZgo+T61KbJcdsRatIekUnrlZY+JEF5bcDTavwm4A5gRIBcK/C4lKwpxg61pVdtszaOiduu/QC0qII/VYHZ5qNdTABHyqz9C/yjv0cnNY1euduilFsRNhpySn7SKNl6P84lM5EdGqmdIvKYALlIzhEwQd/s1gxZGNl0UlAyX3hK5qxIBewf9ZmC/E6usBF5fIBcIvcYOM1T0t8EK2lgiYR+BWaEVlihrKuBbpX3Zqi2Bq4APpfcu8C5CdowQ30xPBAi0KmRMnwMXBKj0vM8k2aR3uWBctM00qnYeWu7+oD61BlKwOoyy+DsANmTvajve63d5kCLsMwzrftEi1FRMv3XafqviUSA61+/t0gR7qmkCIGxwKNSUr9Vi/o8uaOkrbcDf6RgWieWKMCOomnVoEYjoIwp7PVNYdyorYJpHVtNLolpTURAiTO0VCPWK+WyS45Ja6BpnV8S5EysJleFyHs9IpdWcoJSIaAI4FhPu5t9njvQmpVJmyNzZHglyY6PiJwrV9j0xjPWpioy6RFgAF5S1PaGt7F5jSsBcBHQlWK0eK3qQnUH+Si1ImClF8m9r0Z1qdOnxnJEKtfXLp/A8AlwaUT52hHgTfMbPM+tTzpifkiQUwki8kWVaWXfGIfImhNQ4ru/rQabonsSGO8iwmQka2VsAe5Ksh02aAQYNPXNiVoss2Qm8qGQjVH7Rt9uleziRFFdHQnoKtka3z7Q1riixXka7Z1pb4nXjYAigElenLH3cMSLFns8E3miSxl1J6AIYLqnI1brQb9NdzVCZggoApilGMOeWa7GqBkBFAKa2yXXFkqAvltujxsE1IqAbYoFkC++Uus6FwQ8qF2b+4ATdKBhCm5RLggoB+AxmbC1eSWgRTsw/8cEuSPA29fbkVsCDMCtwAKXVwJCMUwAwzNgeaaXAIVMDLPro/JKwD3akLCNzwW22ZE3AkZrv+9l2fYNwPVp5ec0AgGd2nM3d3emMjmLZ4aJDk6zTkC3Njkn6P8+ha2WDjNbrq7hNWBq1glQX7pDCVhSmqhkmVrA6yJivJc8sUm/WarLQVkkwPqgvgQfjzdplIs+vSUwTdG7I8pkhC7SUfa4LBFQJvlqdiTdxb4nw4lTZAaLgDIpMntPiOMW2FLuZDhrBMRNvkpSwf1JzvLTIiBu8lWSCtu8KbZRynDEYBMQN/kqU6myxCSgrqmyaSZLRyUgU8nSFXL6NnijMjUtAuImXw066M/q3OyZzklxCTDfQvrGT76K7HBl9soMFQho2Cszpah2MlxKgDeDtjT0panQa3NFAobstbkqWnyVkqzWe7dI7V27G+ogr1dnfeT68rTLEP4DK8wHBiWPRSkAAAAASUVORK5CYII=">
          <router-link to="/admin/orders" class="fs-5 text-decoration-none text-white ms-3">Orders</router-link>
        </button>
      </div>

      <div class="w-100 mt-2">
        <button class="btn w-full w-100 btn-secondary d-flex align-items-center" type="button">
          <img width="30px" height="30px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAABaElEQVR4nO3ZvUoDURCG4dFG8Qo0Fla2EhvvwcTchPaWrmAREvQ2LMVeBBUjlrkGS8XGStYfFJE3HDNIXM4msYlzcJ4uZ3bDHL79gVkR59yvABtAB3jGniftrT5qE/ukoz0sieAd2AEqYgxQATLtMajFDrrSYibG0d9McBkrhusvWBDjgHntNY8Vv0giKOvXN/JH8ESMwRMxBk/EGDwRY/BEjMETMQZPxBg8EWPwRIzBEzGG/5BIrjVzo9IiYFF7fYwVOwmNTHeHjUzrA0PsLJEh9nrZge0xxvlnJedOA9dMTmvUrmshsoF7JmY2cl5jAs3n2ls8iXEBt/qHS4X1KaCrtYZYB9xosyuF9S1d74p19O+BF234+0EAVPV74xuwKtYBa7qJ+8Lag65vSyJpXGjDB8AcsKcpBE2xDpgBDrXhD+AovFH1d7jUNiUFwHnkMfgJHAPLkgrgBHgF7oBTfbP+ePw658S8HoG/eYRcCNfkAAAAAElFTkSuQmCC">
          <router-link to="/admin/vendors-requests" class="fs-5 text-decoration-none text-white ms-3">Vendors requests</router-link>
        </button>
      </div>
      <div class="w-100 mt-2">
        <button @click="showModal = true" class="btn w-full w-100 btn-secondary d-flex align-items-center" type="button">
          <img height="30px" width="30px"  src="data:image/png;base64,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">
          <label class="fs-5 text-decoration-none text-white ms-3">Send message</label>
        </button>
      </div>

      <modal-form v-if="showModal" @close="showModal = false" @add="addItem"></modal-form>



      <label class="position-absolute bottom-0 text-white ms-4 mb-2">© Copyright Artzone LLC  2024</label>
    </div>
  </div>
  <!-- Подключение jQuery -->

</template>

<script>

import {userStore} from "@/stores/store.js";
import ModalForm from "@/components/ModalForm.vue";

export default {
  name:'navComponent',
  components: {
    ModalForm
  },
  data(){
    return{
      name:'Name',
      showModal: false,
      items: []
    }
  },
  created() {
    const store = userStore();
    const userData = store.get;
    this.name = userData.name;
  },
  methods:{
    reloadPage(){
      location.reload();
    },
    addItem(item) {
      this.items.push(item);
    }
  }
}
</script>

<style>
.c_pointer:hover{
  cursor: pointer;
}
</style>