# laravel-test-examples

### 자주 사용하는 artisan 명령어

* artisan 명령어 목록
```
php artisan list
```

* 개발 서버에서 애플리케이션 가동
```
php artisan serve
```

* 라우트 전체 목록 보기
```
php artisan route:list
```

* controller 클래스 생성
```
php artisan make:controller ListUserController
```

* controller 클래스 생성 (CRUD 리소스 추가)
```
php artisan make:controller ListUserController --resource
```

* controller 클래스 생성 (CRUD 리소스 추가, 리소스 컨트롤러의 모델 인스턴스에 대한 타입힌트 추가)
```
php artisan make:controller ListUserController --resource --model=User
```

* 모델 정의하기
```
php artisan make:model User
```

* 마이그레이션 파일 생성하기
```
php artisan make:migration create_users_table
```

* 마이그레이션 파일 생성하기(테이블을 생성)
```
php artisan make:migration create_users_table --create=users
```

* 마이그레이션 파일 생성하기(테이블을 지정)
```
php artisan make:migration add_votes_to_users_table --table=users
```

* 마이그레이션 실행하기(아직 실행된적이 없는 모든 마이그레이션을 실행)
```
php artisan migrate
```

* 마이그레이션 되돌리기-롤백(가장 최근의 마이그레이션 작업을 되돌리기)
```
php artisan migrate:rollback
```

* 제한된 숫자의 마이그레이션 되돌리기
```
php artisan migrate:rollback --step=2
```

* 모든 마이그레이션 되돌리기
```
php artisan migrate:reset
```

* 롤백과 마이그레이션 함께 실행하기
```
php artisan migrate:refresh
```

* 회윈가입·로그인 뷰·라우트 틀 생성
```
php artisan make:auth
```