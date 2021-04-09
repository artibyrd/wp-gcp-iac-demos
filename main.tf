module "wp-infrastructure" {
  source  = "artibyrd/wp-infrastructure/gcp"
  version = "1.2.0"
  project_id = "terraform-demo-309512"
  region1 = "us-west1"
  region2 = "us-central1"
}