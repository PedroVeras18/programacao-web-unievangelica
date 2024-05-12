import { CarsRepository } from '@/repositories/cars-repository'
import { Car } from '@prisma/client'

interface CreateCarUseCaseRequest {
  page: number
}

interface GetAllCarsUseCaseResponse {
  cars: Car[]
}

export class GetAllCarsUseCase {
  constructor(private carsRepository: CarsRepository) {}

  async execute({
    page,
  }: CreateCarUseCaseRequest): Promise<GetAllCarsUseCaseResponse> {
    const cars = await this.carsRepository.getAll(page)

    return {
      cars,
    }
  }
}
